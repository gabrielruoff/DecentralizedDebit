# DecentralizedDebit

A secure and anonymous cryptocurrency payment processor and point-of-sale system.

To work on this repo:
  1. Edit DATADIR environment variable in .env to point to the repo's path
  2. Download bitcoin core and sync with the network
  3. Configure bitcoin rpc
    - open bitcoin core
    - Settings -> Options -> Open Configuration File
    - paste the contents of conf/bitcoin.conf
    - restart bitcoin core

DecentralizedDebit
Gabriel Ruoff,
geruoff@syr.edu

Abstract
Since the advent of Bitcoin in 2009, decentralized digital currencies have slowly made their way into mainstream social, political, and financial circles. Recently, large corporations such as Tesla Motors have bought into cryptocurrency markets in staggering amounts. Large banks, such as J.P. Morgan and Goldman Sachs, have issued RFI’s with the intention of developing investment strategies relating to digital assets. Even BlackRock, the worst largest asset manager, has been transparent about entering the crypto space. As corporations and financial institutions continue to embrace cryptocurrency as a viable store of value, and retail investors continue to accumulate digital assets, there will, without a doubt, be high demand for the development of public physical and digital ‘crypto-commerce’ infrastructure. So where is this infrastructure? As of now, the greatest argument against the viability of cryptocurrency is that the fee structures of popular assets are not suited for small and frequent transactions, or commonly put, ‘Bitcoin can’t buy you a cup of coffee’. This project serves as a counter-argument to this long-held idea. By utilizing a centralized cryptocurrency payment processing service, the fee structure of cryptographic assets can be leveraged to offer the public low-overhead, high-frequency payment options while preserving their individual anonymity and digital security to the same degree that the underlying digital asset provides.

Structure
	This infrastructure, further referred to as 'The Service’ consists of three systems which cater to two usage groups who are assumed to hold an account on The Service: customers and merchants. A customer is an individual who intends to exchange currency with a merchant who provides them with goods or services. The first system is the central server which stores and processes data. This central server communicates with the other two systems, the merchant-side and customer-side over the internet using an API. The customer-side system allows customers to interact with the central server to manage their user account, while the merchant-side system allows merchants to submit transactions to the central server.

Usage groups:
Customer - individual who purchases an item or service.
Merchant - individual who exchanges goods and services for payment.
Systems:
Central server
Manages data for The Service
Customer and Merchant account credentials
Customer & Merchant wallets
Merchant public keys
Server keys
Handles API calls
Processes transactions
Merchant-side
Submits transactions to the central server
Manages merchant data
Merchant private key
Customer-side
Interacts with the central server and provides account management to the customer


Basic Functionality
	This Service allows the customer to conduct cryptocurrency transactions with a merchant using an NFC-enabled smartphone or physical token, such as a smart card.  Crypto currency may be deposited into the customer’s account, linked to their identifier, from an external source via the customer-side system. This device or token stores encrypted data identifying the customer which can only be decrypted by the central server. At the point of sale, the customer may select the cryptocurrency in which to pay before placing their device or token on a specialized card reader. At this point, the customer’s encrypted data is combined with an encrypted representation of the amount, currency, and recipient merchant of the transaction. This data is finally cryptographically signed by the merchant and submitted to the central server along with the merchant’s credentials.
	Upon receipt of this data, the central server verifies the data against the submitting merchant’s cryptographic data which is stored in a database, as well as referenced against all previous transactions conducted by The Service to prevent duplicate attacks. If verified, the submitted data is decrypted into its constituent parts by the central server, otherwise it is discarded as illegitimate. At this point, the central server accesses both the customer and merchant’s wallets of the selected currency using their decrypted account identifiers in order to facilitate a transaction of the specified amount. Finally, either the success or failure of the submitted transaction is reported back to the merchant.

Anonymity
	As illustrated by the information above, transactions can be conducted via this system with a high degree of customer and merchant anonymity. The only information required to create an account with The Service is a username, password, and source of funds. This is intentional, as the philosophy behind decentralized currency relies highly on the anonymity provided by digital encryption. The Service, though a centralized entity, is able to preserve any level of privacy guaranteed by the underlying currency being exchanged.

Security
	In any situation where a centralized entity is processing financial transactions on behalf of a user or merchant over a public protocol, such as HTTP, it is imperative that the privacy and interests of all users are protected. The Service uses a specialized key-based encryption process in order to ensure that illegitimate transactions can be easily recognized and discarded by the central server. Additionally, this encryption process ensures the anonymity of both the customer and merchant, as it ensures no unencrypted user data may exist outside of The Service’s database.
	This encryption system is composed of two sets of keypairs: the central server’s and a merchant’s. 
Regarding the customer: The only information required by a customer to conduct a transaction is their account identifier which is encrypted to the central server’s public key upon the activation of their device or NFC token, and as such is useless in its raw form to any adversary attempting to deanonymize a user of The Service.
Regarding the merchant: The data that identifies merchants, their secret key, is encrypted and stored locally on the merchant-side, meaning that a merchant’s data cannot be compromised unless an adversary is able to acquire and decrypt this key. An attack revealing this information would not be designed specifically to exploit The Service, but rather the merchant’s individual machine or network. Data that exists in an unencrypted form on the merchant-side could also be targeted, though this would simply consist of the transaction amount and currency, information which, while technically able to assist in deanonymizing a customer or merchant using advanced blockchain analysis, would have to be collected on a large scale and correlated using significant resources.
Regarding the central server: The central server’s security is ultimately determined by the quality of its design, implementation, and upkeep. The server’s ability to securely verify and process information is linked to the safety of its secret key. If this secret key was to be compromised, an adversary could use it to impersonate The Service and therefore decrypt private data. That being said, the only available data would be the user’s username and funds stored in The Service. While this would be an emergency scenario, the attacker would still not be able to correlate any information stored on or submitted to the central server to the real-world identity of any merchant or customer without the significant resources discussed in the previous section, Regarding the merchant.

Block Times and Transaction Fees
The public acceptance of any sort of crypto-commerce infrastructure will be highly dependent on its ability to provide the customer with low overhead fees and higher convenience than alternative payment methods. For example, if someone wanted to buy a $3 coffee with bitcoin and have their transaction confirmed on the blockchain as fast as possible, they would be shelling out eight times the price of their coffee just on transaction fees. If they wanted to pay only the minimum fee, around $0.14, they would have to wait a minimum of 11 hours for their transaction to be confirmed, rendering their ability to pay in bitcoin pointless. By establishing a centralized entity (The Service), these fees can be reduced through the following process:

Leveraging PublicTrust for Pseudo-Elimination of Transaction Delays
In the above example, the customer’s ability to pay in bitcoin with an acceptable fee is rendered useless due to the delay between transaction submission and confirmation. The Service circumvents this due to the fact that both the customer and merchant would be required to register with and hold a wallet controlled by The Service in order to utilize it. Transactions may be sent with high confirmation delays while unconfirmed funds are frozen in the customer’s wallet by the server while simultaneously credited to the merchant’s account but frozen until confirmed. Simply put, since The Service fully administrates the wallets of both parties, access to unsettled funds can be blocked by the central server until their eventual confirmation. Additionally, the event of a failed transaction or any anticipated confirmation error, the funds owed to the merchant will still be secured in the customer’s wallet until the transaction can be properly processed. The coffee example can be reconsidered, as the merchant doesn’t require funds from the customer immediately as long as a trusted third-party guarantees their existence and delivery.
This system depends entirely on the public trust of The Service. It is imperative that any crypto-commerce entity guarantee to its users that the funds owned by or guaranteed to them actually exist. This can be accomplished in a variety of ways that preserve the privacy of The Service and the anonymity of its users. For example, a network of watch-only wallets reflecting assets under The Service’s control could be regularly audited by a third-party.



Vulnerabilities
Duplicate attack
Classic Fraud

