/*
 * 
 * DecentralizedDebit - Gabriel Ruoff, 2021
 * geruoff@syr.edu

   Typical pin layout used:
   -----------------------------------------------------------------------------------------
               MFRC522      Arduino       Arduino   Arduino    Arduino          Arduino
               Reader/PCD   Uno/101       Mega      Nano v3    Leonardo/Micro   Pro Micro
   Signal      Pin          Pin           Pin       Pin        Pin              Pin
   -----------------------------------------------------------------------------------------
   RST/Reset   RST          9             5         D9         RESET/ICSP-5     RST
   SPI SS      SDA(SS)      10            53        D10        10               10
   SPI MOSI    MOSI         11 / ICSP-4   51        D11        ICSP-4           16
   SPI MISO    MISO         12 / ICSP-1   50        D12        ICSP-1           14
   SPI SCK     SCK          13 / ICSP-3   52        D13        ICSP-3           15
*/

#include <SPI.h>
#include <MFRC522.h>

#define RST_PIN         9           // Configurable, see typical pin layout above
#define SS_PIN          10          // Configurable, see typical pin layout above

MFRC522 mfrc522(SS_PIN, RST_PIN);   // Create MFRC522 instance.

MFRC522::MIFARE_Key key;

byte block_height = 8;
byte initial_block_height = 8;
byte next_trailing = 11;
byte block_size = 16;
byte blocks_per_sector = 4;
char chars[16];

bool done = false;

void setup() {

  Serial.begin(9600); // Initialize serial communications with the PC
  while (!Serial);    // Do nothing if no serial port is opened (added for Arduinos based on ATMEGA32U4)
  SPI.begin();        // Init SPI bus
  mfrc522.PCD_Init(); // Init MFRC522 card

  // Prepare the key (used both as key A and as key B)
  // using FFFFFFFFFFFFh which is the default at chip delivery from the factory
  for (byte i = 0; i < 6; i++) {
    key.keyByte[i] = 0xFF;
  }

}

void loop() {

  if (Serial.available() >= 1 && !done) {

    // Reset the loop if no new card present on the sensor/reader. This saves the entire process when idle.
    if ( ! mfrc522.PICC_IsNewCardPresent())
      return;

    // Select one of the cards
    if ( ! mfrc522.PICC_ReadCardSerial())
      return;

    MFRC522::PICC_Type piccType = mfrc522.PICC_GetType(mfrc522.uid.sak);
    //  Serial.println(mfrc522.PICC_GetTypeName(piccType));

    // Check for compatibility
    if (    piccType != MFRC522::PICC_TYPE_MIFARE_MINI
            &&  piccType != MFRC522::PICC_TYPE_MIFARE_1K
            &&  piccType != MFRC522::PICC_TYPE_MIFARE_4K) {
      Serial.println(F("This sample only works with MIFARE Classic cards."));
      return;
    }

    char c = Serial.read();

    if (c == 'r') {
      //      Serial.println("reading mode");
      read_wallet_address(8, key);
      done = true;
    } else if (c == 'w') {
      //      Serial.println("writing mode");
      write_wallet_address();
      done = true;
    }

  }

}

void read_wallet_address(byte starting_block, MFRC522::MIFARE_Key keyA) {

  // start on sector 2
  byte first_sector = 2;
  byte first_block = 8; byte root_block = first_block;
  byte next_trailing = 11;
  byte block_size = 16;
  byte blocks_per_sector = 4;
  byte top_block = 63;

  char deliminator = '!';
  char terminator = '!';

  MFRC522::StatusCode status;
  byte buffer[18];
  byte size = sizeof(buffer);

  // char array of read data
  byte data[18];

  // start at the first sector
  bool terminated = false;
  int dataindex;
  while (!terminated) {

    // Authenticate using key A
    //    Serial.println(F("Authenticating using key A..."));
    status = (MFRC522::StatusCode) mfrc522.PCD_Authenticate(MFRC522::PICC_CMD_MF_AUTH_KEY_A, next_trailing, &keyA, &(mfrc522.uid));
    if (status != MFRC522::STATUS_OK) {
      Serial.print(F("PCD_Authenticate() failed: "));
      Serial.println(mfrc522.GetStatusCodeName(status));
      return;
    }

    for (int i = root_block; i < next_trailing; i++) {

      status = (MFRC522::StatusCode) mfrc522.MIFARE_Read(i, buffer, &size);
      if (status != MFRC522::STATUS_OK) {
        //        Serial.print(F("MIFARE_Read() failed: "));
        Serial.println(mfrc522.GetStatusCodeName(status));
      }

      // dump read data into data array
      int correction_factor = ((root_block - first_block) / blocks_per_sector) * block_size;
      dataindex = 0;
      for (int j = (i - first_block) * block_size; j < (i - first_block + 1)*block_size; j++) {
        data[dataindex] = buffer[(j - ((i - first_block) * block_size))];
        dataindex++;
      }

      // print each character to serial
      for (int i = 0; i < dataindex; i++) {
        Serial.print(char(data[i]));
        //        Serial.print(" ");
      }

      // if the buffer ends with the termination sequence, stop reading
      if (buffer[15] == byte(terminator)) {
        terminated = true;
        break;
      }

    }

    root_block += blocks_per_sector;
    next_trailing += blocks_per_sector;

  }

}

void write_wallet_address() {


  int i = 0;
  int recv = 0;
  int remaining = 0;

  if (Serial.available()) {

    // put your main code here, to run repeatedly:
    do {
      Serial.println("writing mode");
      //        Serial.print(recv); Serial.print(" available: "); Serial.println(Serial.available());

      remaining = Serial.available();
      Serial.println(remaining);
      if (remaining > 15) {
        Serial.readBytes(chars, 16);
        write_block(key, key);
        recv += 16;
      }

    } while (recv < 336);

    //    remaining = Serial.available();
    Serial.print("remaining: ");
    Serial.println(remaining);
    Serial.readBytes(chars, 8);
    for (int i = sizeof(chars) - 8; i < sizeof(chars); i++)
      chars[i] = byte('!');

    write_block(key, key);

    // Dump debug info about the card; PICC_HaltA() is automatically called
    mfrc522.PICC_DumpToSerial(&(mfrc522.uid));
    // Halt PICC
    mfrc522.PICC_HaltA();

    mfrc522.PCD_StopCrypto1();

  }

}

void write_block(MFRC522::MIFARE_Key keyA, MFRC522::MIFARE_Key keyB) {

  // determine how many blocks will be used
  float num_blocks = 1;
  Serial.println(num_blocks);

  // determine how many sectors will be used
  int num_sectors = round(num_blocks / 4);

  int _current = 0;

  // convert message into a block
  byte block[block_size];

  for (int i = 0; i < sizeof(block); i++) {

    block[i] = chars[_current];

    // if we haven't filled a whole block, write terminator to the rest of it
    if (chars[_current] == '!' && i < block_size) {

      for (int j = i + 1; j < block_size; j++) {
        block[j] = byte('!');
      }
      break;
    }

    _current++;

  }

  MFRC522::StatusCode status;
  byte buffer[18];
  byte size = sizeof(buffer);

  // Authenticate using key A
  Serial.println(F("Authenticating using key A..."));
  status = (MFRC522::StatusCode) mfrc522.PCD_Authenticate(MFRC522::PICC_CMD_MF_AUTH_KEY_A, next_trailing, &keyA, &(mfrc522.uid));
  if (status != MFRC522::STATUS_OK) {
    Serial.print(F("PCD_Authenticate() failed: "));
    Serial.println(mfrc522.GetStatusCodeName(status));
    return;
  }

  // Authenticate using key B
  Serial.println(F("Authenticating again using key B..."));
  status = (MFRC522::StatusCode) mfrc522.PCD_Authenticate(MFRC522::PICC_CMD_MF_AUTH_KEY_B, next_trailing, &keyB, &(mfrc522.uid));
  if (status != MFRC522::STATUS_OK) {
    Serial.print(F("PCD_Authenticate() failed: "));
    Serial.println(mfrc522.GetStatusCodeName(status));
    return;
  }

  // for each block to be written, starting with the first, write to the sector
  
    // if this is the next trailing block, skip it and increment next_trailing
    // not doing so will brick the card
    if (block_height == next_trailing) {
      block_height++; next_trailing += 4;
      // authenticate this next sector using key B
      status = (MFRC522::StatusCode) mfrc522.PCD_Authenticate(MFRC522::PICC_CMD_MF_AUTH_KEY_B, next_trailing, &keyB, &(mfrc522.uid));
      if (status != MFRC522::STATUS_OK) {
        Serial.print(F("PCD_Authenticate() failed: "));
        Serial.println(mfrc522.GetStatusCodeName(status));
        return;
      }
    }

    // Write chars to the block
    Serial.print(F("Writing chars into block ")); Serial.println(block_height);
    status = (MFRC522::StatusCode) mfrc522.MIFARE_Write(block_height, block, block_size);
    if (status != MFRC522::STATUS_OK) {
      Serial.print(F("MIFARE_Write() failed: "));
      Serial.println(mfrc522.GetStatusCodeName(status));
    }


  block_height++;

}

/**
   Helper routine to dump a byte array as hex values to Serial.
*/
void dump_byte_array(byte *buffer, byte bufferSize) {
  for (byte i = 0; i < bufferSize; i++) {
    Serial.print(buffer[i] < 0x10 ? " 0" : " ");
    Serial.print(buffer[i], HEX);
  }
}
