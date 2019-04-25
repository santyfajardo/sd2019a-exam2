# fluentd/Dockerfile
FROM fluent/fluentd:v1.2.6-debian
RUN ["gem", "install", "fluent-plugin-elasticsearch", "--no-rdoc", "--no-ri", "--version", "1.9.2"]
RUN rm /fluentd/etc/fluent.conf
COPY ./conf/fluent.conf /fluentd/etc 

