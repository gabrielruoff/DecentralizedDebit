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
Handles API calls
Processes transactions
Merchant-side
Submits transactions to the central server
Customer-side
Interacts with the central server and provides account management to the customer


Security
	In any situation where a centralized entity is processing financial transactions on behalf of a user or merchant over a public protocol, such as HTTP, it is imperative that the privacy and interests of all users are protected. The Service uses a specialized key-based encryption process in order to ensure that illegitimate transactions can be easily recognized and discarded by the central server. Additionally, this encryption process ensures the anonymity of the customer, as it ensures no unencrypted user data may exist outside of The Service’s database.

