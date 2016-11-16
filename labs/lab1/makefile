
#-------------------------------------------------------------------------------
#	configure these variables as needed
#-------------------------------------------------------------------------------

files=./JavaCrypto
src=./JavaCrypto/src/pt/ulisboa/tecnico/meic/sirs/*.java
classpath=./JavaCrypto/target
package=pt.ulisboa.tecnico.meic.sirs



#-------------------------------------------------------------------------------
#	standard makefile comands
#-------------------------------------------------------------------------------

all: clean compile gen-aes-key gen-des-key bonus


clean:
	rm -rf $(classpath)
	rm -rf $(files)/intro/outputs
	rm -rf $(files)/grades/outputs


compile:
	mkdir $(classpath)
	mkdir $(files)/intro/outputs
	mkdir $(files)/grades/outputs/
	javac -d $(classpath) $(src)



#-------------------------------------------------------------------------------
#	comands from the lab 1 guide
#-------------------------------------------------------------------------------

otp:
	java -cp $(classpath) $(package).RandomImageGenerator \
	$(files)/intro/outputs/otp.png \
	480 480
	
	java -cp $(classpath) $(package).ImageXor \
	$(files)/intro/inputs/tecnico-0480.png \
	$(files)/intro/outputs/otp.png $(files)/intro/outputs/encrypted-tecnico.png
	
	java -cp $(classpath) $(package).ImageXor $(files)/intro/inputs/tux-0480.png \
	$(files)/intro/outputs/otp.png \
	$(files)/intro/outputs/encrypted-tux.png
	
	java -cp $(classpath) $(package).ImageXor \
	$(files)/intro/outputs/encrypted-tecnico.png \
	$(files)/intro/outputs/encrypted-tux.png \
	$(files)/intro/outputs/tecnico-tux.png


gen-aes-key:
	[ -s $(files)/intro/outputs/aes.key ] || \
	java -cp $(classpath) $(package).AESKeyGenerator \
	w \
	$(files)/intro/outputs/aes.key
	
gen-des-key:
	[ -s $(files)/intro/outputs/des.key ] || \
	java -cp $(classpath) $(package).DESKeyGenerator \
	w \
	$(files)/intro/outputs/des.key


ecb: gen-aes-key
	java -cp $(classpath) $(package).ImageAESCipher \
	$(files)/intro/inputs/glider-0480.png \
	$(files)/intro/outputs/aes.key \
	ECB \
	$(files)/intro/outputs/glider-aes-ecb.png

	
des: gen-des-key
	java -cp $(classpath) $(package).ImageDESCipher \
	$(files)/intro/inputs/glider-0480.png \
	$(files)/intro/outputs/des.key \
	ECB \
	$(files)/intro/outputs/glider-des-ecb.png


cbc: cbc1 cbc2


cbc1: gen-aes-key
	java -cp $(classpath) $(package).ImageAESCipher \
	$(files)/intro/inputs/glider-0480.png \
	$(files)/intro/outputs/aes.key \
	CBC \
	$(files)/intro/outputs/glider-aes-cbc.png


cbc2: gen-aes-key
	java -cp $(classpath) $(package).ImageAESCipher \
	$(files)/intro/inputs/tux-0480.png \
	$(files)/intro/outputs/aes.key \
	CBC \
	$(files)/intro/outputs/tux-aes-cbc.png
	
	java -cp $(classpath) $(package).ImageAESCipher \
	$(files)/intro/inputs/tecnico-0480.png \
	$(files)/intro/outputs/aes.key \
	CBC \
	$(files)/intro/outputs/tecnico-aes-cbc.png
	
	convert \
	$(files)/intro/inputs/tux-0480.png \
	$(files)/intro/inputs/tecnico-0480.png \
	+append \
	$(files)/intro/outputs/tux-tecnico-0480.png
	
	java -cp $(classpath) $(package).ImageAESCipher \
	$(files)/intro/outputs/tux-tecnico-0480.png \
	$(files)/intro/outputs/aes.key \
	CBC \
	$(files)/intro/outputs/tux-tecnico-0480-aes-cbc.png
	
# FIXME
# do the same with jpeg


ofb: gen-aes-key
	java -cp $(classpath) $(package).ImageAESCipher \
	$(files)/intro/inputs/glider-0480.png \
	$(files)/intro/outputs/aes.key \
	OFB \
	$(files)/intro/outputs/glider-aes-ofb.png
	
	java -cp $(classpath) $(package).ImageAESCipher \
	$(files)/intro/inputs/tux-0480.png \
	$(files)/intro/outputs/aes.key \
	OFB \
	$(files)/intro/outputs/tux-aes-ofb.png

	java -cp $(classpath) $(package).ImageAESCipher \
	$(files)/intro/inputs/tecnico-0480.png \
	$(files)/intro/outputs/aes.key \
	OFB \
	$(files)/intro/outputs/tecnico-aes-ofb.png
	
# this is what the guide asks but I think they meant the other command
# 	java -cp $(classpath) $(package).ImageXor \
# 	$(files)/intro/inputs/tux-0480.png \
# 	$(files)/intro/outputs/tecnico-aes-ofb.png \
# 	$(files)/intro/outputs/XOR-tux-tecnico-aes-ofb.png
	
	java -cp $(classpath) $(package).ImageXor \
	$(files)/intro/outputs/tux-aes-ofb.png \
	$(files)/intro/outputs/tecnico-aes-ofb.png \
	$(files)/intro/outputs/XOR-tux-tecnico-both-aes-ofb.png


asym-openSSL:
# FIXME
# having problems using openSSL through the makefile
# I think it's specific to my system, will check later

	openssl genrsa -out server.key
	
	openssl rsa -in server.key -pubout > public.key
	
	openssl req -new -key server.key -out server.csr
	
	openssl x509 -req -days 365 -in server.csr -signkey server.key -out server.crt

	echo 01 > server.srl
	
	openssl x509 -req -days 365 -in user.csr -CA server.crt -CAkey server.key -out user.crt
	
	openssl dgst -sha256 $(files)/grades/inputs/grades.txt > grades.sha256
	
	openssl rsautl -sign -inkey server.key -keyform PEM -in grades.sha256 > grades.sig

	openssl rsautl -verify -in grades.sig -inkey server.key
	
	openssl dgst -sha256 $(files)/grades/inputs/grades.txt
	
	openssl verify -CAfile server.crt user.crt


asym-java:
	java -cp $(classpath) $(package).RSAKeyGenerator \
	w \
	$(files)/intro/outputs/priv.key \
	$(files)/intro/outputs/pub.key

# FIXME
# TODO	ImageRSACipher class
# TODO	ImageRSADecipher class



bonus:

	java -cp $(classpath) $(package).FileAESCipher \
	$(files)/grades/inputs/grades.txt \
	$(files)/intro/outputs/aes.key \
	ECB \
	$(files)/grades/outputs/grades.ecb.aes

	
	java -cp $(classpath) $(package).FileAESCipher \
	$(files)/grades/inputs/grades.txt \
	$(files)/intro/outputs/aes.key \
	CBC \
	$(files)/grades/outputs/grades.cbc.aes
	
	java -cp $(classpath) $(package).FileAESCipher \
	$(files)/grades/inputs/grades.txt \
	$(files)/intro/outputs/aes.key \
	OFB \
	$(files)/grades/outputs/grades.ofb.aes
	
	java -cp $(classpath) $(package).Base64Encode \
	$(files)/grades/outputs/grades.cbc.aes \
	$(files)/grades/outputs/grades.cbc.aes.b64
	
	java -cp $(classpath) $(package).Base64Decode \
	$(files)/grades/outputs/grades.cbc.aes.b64 \
	$(files)/grades/outputs/grades.cbc.aes.b64.decoded
	
	diff \
	$(files)/grades/outputs/grades.cbc.aes \
	$(files)/grades/outputs/grades.cbc.aes.b64.decoded	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	


# 
# 	java -cp $(classpath) $(package).Base64Encode \
# 	$(files)/grades/outputs/grades-21.cbc.aes \
# 	$(files)/grades/outputs/grades-21.cbc.aes.b64
# 	
# 	diff \
# 	$(files)/grades/outputs/grades.cbc.aes.b64 \
# 	$(files)/grades/outputs/grades-21.cbc.aes.b64
# 	
# 	java -cp $(classpath) $(package).FileAESDecipher \
# 	$(files)/grades/outputs/grades.cbc.aes.b64.decoded \
# 	$(files)/intro/outputs/aes.key \
# 	CBC \
# 	$(files)/grades/outputs/grades-20.cbc.aes
# 
# 	diff \
# 	$(files)/grades/inputs/grades.txt \
# 	$(files)/grades/outputs/grades-20.cbc.aes

	


