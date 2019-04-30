#!/bin/bash
while true
do
	x= `echo $(($RANDOM%1))`
	if [$x= 1]
	then
  		watch -n 1 curl 192.168.130.160:3306 -X GET
		sleep 2
	else 
		watch -n 1 curl 192.168.130.160:3306/mala -X GET]
		sleep 2
	fi
done
