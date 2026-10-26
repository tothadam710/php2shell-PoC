
FROM kalilinux/kali-rolling

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y --no-install-recommends \
    bash \
    ca-certificates \
    curl \
    wget \
    git \
    python3 \
    python3-pip \
    iproute2 \
    iputils-ping \
    net-tools \
    dnsutils \
    netcat-openbsd \
    nmap \
    tcpdump \
    traceroute \
    jq \
    vim \
    less \
    procps \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /root/lab

CMD ["bash"]
