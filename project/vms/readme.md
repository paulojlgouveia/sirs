
virtual machines for the project.

## vm1 - webserver




| element            | configuration                    |
| ------------------ | -------------------------------- |
| vm name            | sirs_webserver                   |
| type               | linux                            |
| version            | red hat (64-bit)                 |
| drive size         | 8 gb                             |
| base memory        | 1024 mb                          |
| video memory       | 16 mb                            |
| hostname           | centered                         |


| adapter 1          | configuration                    |
| ------------------ | -------------------------------- |
| attaame            | bridged adapter                  |


| element            | configuration                    |
| ------------------ | -------------------------------- |
| hostname           | webserver                        |
| ip address         | 192.168.1.168                    |
| OS                 | CentOS 7                         |
| users              | root : root ; admin : admin      |
| software           |                                  |



state




## vm2 - database server

(not implemented yet)