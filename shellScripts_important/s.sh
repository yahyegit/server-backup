#!/bin/bash 

SIZE=$( du -sb  /var/lib/mysql/ | awk -F " " '/1/ {print $1}' )    
# 2GB = 2147483648 bytes
# 10GB = 10737418240 bytes


if(( $SIZE >= 2147483648 )) 
then
    echo a is greater than or equal to b. 
else
    echo a is not greater than or equal to b. 
fi
