from __init__ import *
from Db_connect import Send
import getmac
from domain_reg_ex import domainFinder
from data_usage import dataUsage

print 'all libraries have been called'
def process_url(packet):
    mac_address = getmac.get_mac_address()
    if IP in packet:
        ipsrc = packet[IP].src
        ipdst = packet[IP].dst
        srcmac = format(packet.src)
        dstmac = format(packet.dst)
        if DNSQR in packet and packet.dport == 53:
            if mac_address == srcmac or mac_address == dstmac:
                query = packet[DNSQR].qname
                if query.endswith('.'):
                    query = query[:-1]
                    domain = domainFinder(query)
                    json_data = {"logged_on_user": logged_on_user, "computer_name": computer_name, "source_mac": srcmac,
                                 "url": query,"domain_name":domain, "destination_mac": dstmac, "source_ip": ipsrc,
                                 "destination_ip": ipdst, "packet_size": len(packet)}
                    Send().InsertintoDb("processed_logs", json_data)
        elif DNSRR in packet and packet.sport == 53:
            if mac_address == srcmac or mac_address == dstmac:
                response = packet[DNSQR].qname
                if response.endswith('.'):
                    response = response[:-1]
                    domain = domainFinder(response)
                    json_data = {"logged_on_user": logged_on_user, "computer_name": computer_name, "source_mac": srcmac,
                                 "url": response,"domain_name":domain, "destination_mac": dstmac, "source_ip": ipsrc,
                                 "destination_ip": ipdst, "packet_size": len(packet)}
                    Send().InsertintoDb("processed_logs", json_data)
        elif packet.haslayer(http.HTTPRequest):
            http_layer = packet.getlayer(http.HTTPRequest)
            https = '{0[Host]}{0[Path]}'.format(http_layer.fields)
            json_data = {"logged_on_user": logged_on_user, "computer_name": computer_name, "source_mac": srcmac,
                         "url": https, "destination_mac": dstmac, "source_ip": ipsrc,
                         "destination_ip": ipdst, "packet_size": len(packet)}
            Send().InsertintoDb("processed_logs",json_data)
def getData():
    mac_address = getmac.get_mac_address()
    bytes = dataUsage()
    bytes_sent = bytes[2]
    bytes_received = bytes[0]
    json_data = {"logged_on_user": logged_on_user, "computer_name": computer_name,"mac_address":mac_address,
                 "bytes_sent":bytes_sent,
                 "bytes_received": bytes_received}
    Send().InsertintoDb("data_usage", json_data)










