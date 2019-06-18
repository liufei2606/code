FROM bluedata/rhel7
EXPOSE 80
COPY docker.repo /etc/yum.repos.d/
RUN yum install -y httpd
ADD index.html /var/www/html
CMD ["/usr/sbin/httpd","-D","FOREGROUND"]
