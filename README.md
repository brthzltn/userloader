## Fejlesztéshez használt eszközök

  - Php 7.2
  - Myql 5.7
  - Yii2 php keretrendszer
  - Phpstorm
  - Windows 7 (tudom már cserélendő)
     Mivel a windows case-insensitive és nem teszteltem linux-on, 
     ezért linuxon futtatva előfordulhat 
     kis-nagybetű probléma a fájlnevekben, azaz lehet, hogy nem 
     talál meg bizonyos nevű fájlt.

## Telepítés

1. Forrás letöltése git-ből.

2. Adatbázis létrehozása.
    sql\create_database.sql futtatása mysql-ben, root-ként.
    Létrehozza a 
      - brth_userload_555_user felhasználót
      - brth_userload_555 adatbázist
      - loaded_users táblát
      - brth_userload_555 megkap minden jogot a  
        brth_userload_555 adatbázishoz

    Megjegyzés: nagy rendszerek fejlesztésén "nőttem" fel, ahol 
    általában az adatbázis "kiemelt figyelmet" kap.
    Azaz az adatbázis létrehozását, változásait inkább erre szolgáló
    sql szkriptekel szeretem végezni, nem szoktam a backend rendszerek
    migráló metódusait használni.

3. Apache konfigurálása 
	Alias létrehozása:

	​     Alias /brth_userload ".../app/frontend/web/"
	​     <Directory ".../app/frontend/web/">
	​          Options All 
	​          AllowOverride All
	​          Order allow,deny
	​          Allow from all
	​      </Directory>

4. Alkalmazás paraméterek ellenőrzése (beállítása)

	Adatbázis kapcsolat beállítása (csak szükség esetén):
  
  ​     ...\app\common\config\main-local.php

	​     'db' szekció
  
  Forrás url:
  
  ​     ...\app\common\config\params-local.php
  
  ​     'source_url' paraméter

## Megjegyzések

- A feladatnak az olvasatomban nem volt része bejelentkezés illetve jogosultság kezelés.
  Nagyvonalúan kihagytam őket.
- A magukat a képeket nem, csak a hozzájuk vezető url-eket töltöttem át (szintén az értelmezésem szerint).
- A részletes hibaüzenetek a log-ban keletkeznek a felületre (frontend, console) csak a hiba
  tényét jelzem ki.
  
  Log könyvtárak: 
      frontend\runtime\logs
      console\runtime\logs


## A feldatot végző komponensek

...\app\frontend\controllers\LoadedUsersController.php

   A komponens nagy részét a Yii generátora végezte. Az actionLoad metódus a saját, az végzi a felhasználók áttöltését a UsersLoader osztály segítségével.

...\app\common\components\UsersLoader.php

   Az áttöltést végző osztály.   

...\app\console\controllers\LoadedUsersController.php

   A konzol parancsot kiszolgáló controller osztály.


## Működtetés / használat

A felhasználókat a Felhasználók menüpontban lehet megnézni, karbantartani, áttölteni.
Parancsorból a program fő könyvtárban lévő run_loaduser.bat (windows) vagy run_loaduser.sh (linux)
szkriptekkel lehetséges (utóbbi nincs tesztelve ebben a programban)



