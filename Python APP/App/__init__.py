from scapy.all import *
from scapy.layers.dns import DNSRR, DNS, DNSQR
from scapy_http import http
import threading
import socket
import getpass

logged_on_user = getpass.getuser()

computer_name = socket.gethostname()