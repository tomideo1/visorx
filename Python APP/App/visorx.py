from App.logsController import *


def sniffer_url():
    while True:
        try:
            sniff(filter="port 53", prn=process_url, timeout=10)
        except:
            continue


def storeData():
    while True:
        try:
            getData()
        except:
            continue


t1 = Thread(target=sniffer_url)
t2 = Thread(target=storeData)


def main():
    t2.start()
    t1.start()


if __name__ == '__main__':
    main()
