def domainFinder(url):
    isIp = False
    for char in url:
        if char.isalpha():
            isIp = True
    if isIp:
        arrayOfUrl = url.split('/')
        subDomain = ""
        for i in arrayOfUrl:
            if(i.find('.') != -1):
                subDomain = i
        arrayOfSubDomain = subDomain.split('.')
        arrayOfDomain = arrayOfSubDomain[-2: ]
        domain = '.'.join(arrayOfDomain)
        return domain
    else:
        domain = ""