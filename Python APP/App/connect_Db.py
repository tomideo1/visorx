import pymongo
class Send:
    def __init__(self):
        self.myclient = pymongo.MongoClient("mongodb://localhost:27017/")
        self.mydb = self.myclient["visorx"]
    def InsertintoDb(self, table, dict):
        """Take dictionary object dict and produce sql for
        inserting it into the named document"""
        self.mycol = self.mydb[table]
        query = self.mycol.insert_one(dict)
        return query

