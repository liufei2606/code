

#/bin/sh

# set timezone
echo "set timezone"
timedatectl set-timezone Asia/Shanghai

echo "vagrant ALL=(ALL) NOPASSWD: ALL" >> /etc/sudoers

# change yum repo
echo "change yum repo -> aliyun repo"
sudo yum install -y wget yum-utils
sudo cp /etc/yum.repos.d/CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo.bak
sudo wget -O /etc/yum.repos.d/CentOS-Base.repo http://mirrors.aliyun.com/repo/Centos-7.repo
sudo wget -P /etc/yum.repos.d/ http://mirrors.aliyun.com/repo/epel-7.repo 
sudo yum clean all
sudo yum makecache

# install some tools
echo "install some tools"
sudo yum install -y yum-utils device-mapper-persistent-data lvm2 git vim gcc glibc-static telnet bridge-utils

# install docker
echo "install docker"
sudo yum-config-manager --add-repo http://mirrors.aliyun.com/docker-ce/linux/centos/docker-ce.repo
sudo yum makecache fast
sudo yum -y install docker-ce

# start docker service
echo "start docker service"
sudo groupadd docker
sudo usermod -aG docker vagrant
sudo systemctl enable docker
