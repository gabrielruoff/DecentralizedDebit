# DecentralizedDebit

A secure and anonymous cryptocurrency payment processor and point-of-sale system.

To work on this repo:
  1. Edit DATADIR environment variable in .env to point to the repo's path
  2. Download bitcoin core and sync with the network*
  4. Configure bitcoin rpc*
    - open bitcoin core
    - Settings -> Options -> Open Configuration File
    - paste the contents of conf/bitcoin.conf
    - restart bitcoin core

*Or point /lib/Bitcoin.py to a remote bitcoind instance


Gabriel Ruoff, geruoff@syr.edu
