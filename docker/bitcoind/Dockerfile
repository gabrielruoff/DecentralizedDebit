FROM ubuntu:20.04

ENTRYPOINT [ "/bin/bash", "-l", "-c" ]

RUN apt-get -qq -y update \
    && apt-get -qq -y install wget \
    curl \
    gnupg \
    apt-transport-https \
    supervisor

# install bitcoind prereqs
RUN DEBIAN_FRONTEND=noninteractive apt-get -qq -y install build-essential \
    libtool \
    autotools-dev \
    autoconf \
    libssl-dev \
    libboost-all-dev\
    software-properties-common

# install bitcoind
RUN mkdir -p /tmp/btc \
  && wget -O  /tmp/btc/btcsrc.gz https://bitcoin.org/bin/bitcoin-core-0.20.0/bitcoin-0.20.0-x86_64-linux-gnu.tar.gz \
  && tar -xvf /tmp/btc/btcsrc.gz --directory /tmp/btc \
  && cp -r /tmp/btc/bitcoin-0.20.0/bin/* /usr/local/bin/ \
  && rm -rf /tmp \
  && chmod 700 /usr/local/bin/*

# copy conf file
COPY bitcoin.conf /root/.bitcoin/bitcoin.conf

COPY supervisord.conf /etc/supervisor/supervisord.conf

WORKDIR /data
EXPOSE 8332
CMD ["bitcoind"]
