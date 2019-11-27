import time
import psutil
from psutil import net_io_counters

def byteRecvd():
    net_io_counters.cache_clear()
    bytes_received = psutil.net_io_counters().bytes_recv
    bytes_received = int(convert_to_gbit(bytes_received))
    time.sleep(5)
    return bytes_received

def byteSent():
    net_io_counters.cache_clear()
    bytes_sent = psutil.net_io_counters().bytes_sent
    bytes_sent = int(convert_to_gbit(bytes_sent))
    time.sleep(5)
    return bytes_sent

def convert_to_gbit(value):
    return value

def send_stat(value):
    print ("%0.3f" % convert_to_gbit(value))



def calculatedataUsage(bytes_received, previous,bytes_sent,previous_2):
    result = [0,0,0,0]
    if bytes_received != 0 and bytes_received > previous:
        result[0] = (bytes_received - previous)
    elif bytes_received < previous:
        result[0] = bytes_received
    else:
        result[0] = 0
    result[1] = bytes_received
    if bytes_sent !=0 and bytes_sent > previous_2:
        result[2] = (bytes_sent - previous_2)
    elif bytes_sent < previous_2:
        result[2] = bytes_sent
    else:
        result[2] = 0
    result[3] = bytes_sent
    return result
previous = 0
previous_2 = 0
def dataUsage():
    global previous, previous_2
    while True:
        data1 = byteRecvd()
        data2 = byteSent()
        result = []
        result = calculatedataUsage(data1,previous,data2,previous_2)
        previous = result[1]
        previous_2 = result[3]
        #hint result[0] is bytes received and result[2] is bytes sent
        return result
# previous = 0
# previous_2 = 0
# while True:
#     data = dataUsage()
#     res = []
#     res = calculatedataUsage(data,previous)
#     previous = res[1]
#     print res[0]

