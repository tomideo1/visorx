import mysql.connector
import configparser

class Send:
    def __init__(self):
        self.config = configparser.ConfigParser()
        config_path = r'C:\Program Files (x86)\HalogenSecurity\visorx\config.ini'
        self.config.read(config_path)
        self.mydb = mysql.connector.connect(host=self.config['mysql']['host'], user=self.config['mysql']['user'],
                                            passwd=self.config['mysql']['passwd'], db=self.config['mysql']['database'],
                                            port=self.config['mysql']['port'])
        self.mycursor = self.mydb.cursor()

    def get_host_server(self):
        host_name = self.config['mysql']['host']
        return host_name
    def delete_from_db(self,string):
        sql = " DELETE FROM raw_logs WHERE logs like '%"+string +"%' "
        self.mycursor.execute(sql)
        self.mydb.commit()

    def Query(self,table, dict):
        """Take dictionary object dict and produce sql for
        inserting it into the table"""
        sql = 'INSERT INTO ' + table
        sql += ' ('
        sql += ', '.join(dict)
        sql += ',date_time_logged'
        sql += ') VALUES ('
        sql += ', '.join(map(self.JsonKeys, dict))
        sql +=  ',now()'
        sql += ');'
        return sql

    def JsonKeys(self,key):
        return '%(' + str(key) + ')s'

    def InsertintoDb(self,table,data):
        sql = self.Query(table,data)
        self.mycursor.execute(sql,data)
        self.mydb.commit()


