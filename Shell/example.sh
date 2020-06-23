[root@localhost bin]# vi pullK8s.sh

#!/bin/bash
KUBE_VERSION=v1.14.0
KUBE_PAUSE_VERSION=3.1
ETCD_VERSION=3.3.10
DNS_VERSION=1.3.1
username=registry.cn-hangzhou.aliyuncs.com/google_containers

images=(kube-proxy-amd64:${KUBE_VERSION}
kube-scheduler-amd64:${KUBE_VERSION}
kube-controller-manager-amd64:${KUBE_VERSION}
kube-apiserver-amd64:${KUBE_VERSION}
pause:${KUBE_PAUSE_VERSION}
etcd-amd64:${ETCD_VERSION}
coredns:${DNS_VERSION}
    )

for image in ${images[@]}
do
　　 new_image=`echo $image|sed 's/-amd64//g'` ##此处需删除“-amd64”,否则kuadm还是无法识别本地镜像
    docker pull ${username}/${image}
    docker tag ${username}/${image} k8s.gcr.io/${new_image}
    #docker tag ${username}/${image} gcr.io/google_containers/${image}
    docker rmi ${username}/${image}
done
