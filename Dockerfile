FROM registry.access.redhat.com/ubi8/php-80@sha256:eaafdac16806d1d00478a3f7a8112c013a36cd275e6ea39aa1a97d3a42fdc302
MAINTAINER Chris Jenkins "chrisj@redhat.com"
EXPOSE 8000
COPY . /opt/app-root/src
CMD /bin/bash -c 'php -S 0.0.0.0:8000'
