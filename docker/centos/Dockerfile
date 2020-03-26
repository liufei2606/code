FROM    centos
MAINTAINER      Henry "liboming88@yeah.net"

RUN     /bin/echo 'root:123456' |chpasswd
RUN     useradd henry
RUN     /bin/echo 'henry:123456' |chpasswd
RUN     /bin/echo -e "LANG=\"en_US.UTF-8\"" >/etc/default/local
EXPOSE  22
EXPOSE  80
CMD     /usr/sbin/sshd -D
