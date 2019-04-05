#!/usr/bin/env python3

import socket
import array
import string
import time,sys
import mysql.connector

HOST = '192.168.254.174'  # The server's hostname or IP address
PORT = 2019        # The port used by the server

mydb = mysql.connector.connect(
host = "localhost",
user = "root",
passwd = "",
database = "watpress_db"
)

rates = []

with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s:
	s.bind((HOST, PORT))
	s.listen()
	conn, addr = s.accept()

	#stop insert when exist
	stopper = 0

	with conn:
		print('Connected by: ', addr)

		#temp storage for location query
		temp_id = ""
		get_location = conn.recv(1024).decode()

		while True:
			data = conn.recv(1024)
			my_bytes = array.array('f', data)
			information = my_bytes.tolist()

			latitude = "%.8f" % information[0]
			longitude ="%.6f" % information[1]
			pressure = "{0:0.0f}".format(information[2])
			waterflow = "%.3f" % information[3]

			#Check location if exist
			mycursor = mydb.cursor()
			mycursor.execute("SELECT id FROM tbl_location WHERE locationName = '"+get_location+"' AND status = 0")
			location_result = mycursor.fetchall()

			for loc_res in location_result:
				if len(loc_res) > 0:
					temp_id = str(loc_res[0])

			#Insert to tbl_location
			if stopper == 0:
				mycursor = mydb.cursor()
				#insertQuery once
				sql = "INSERT INTO tbl_location_request (location_name, latitude,longitude) VALUES('"+get_location+"',"+latitude+", "+longitude+")"
				mycursor.execute(sql)
				mydb.commit()

			if len(temp_id) > 0:
				mycursor = mydb.cursor()
				#Continue adding if location exist
				sql = "INSERT INTO tbl_rates (locationID, pressure, waterflow, dateAdded) VALUES('"+temp_id+"',"+pressure+", "+waterflow+", NOW())"
				mycursor.execute(sql)
				mydb.commit()
			stopper+=1

			print(information)
			print(stopper)
			print(temp_id)
			print(latitude,longitude,pressure,waterflow)
