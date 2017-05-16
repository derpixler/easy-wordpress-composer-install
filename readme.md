....

# Ein paar Worte zu diesem Repo

Was du hier bekommst, sind Beispiel Dateien mit den du ein WordPress mit composer installieren kannst.

## Kurz erklärt

 * prepare.sh - ist ein bashscript, welches die wp-config.php.dist nach `html/` kopiert.
 * wp-config.php.dist - zum versionieren von Änderungen an der config.
 * deployer.php - [deployer.org](deployer.org) wird zum deployen verwendet. Siehe: [Deployment - state of the art](https://github.com/derpixler/Deployment-state-of-the-art)
 * composer.json - Projektzusammensetzung

## How to use

1. Git Repo clonen: `$ git clone https://github.com/derpixler/easy-wordpress-composer-install.git dein-projekt`
2. In das Verzeichniss `$ cd dein-projekt` wechseln
3. Öffne die `deployer.php` und ergänze deine Server
4. Öffne `wp-config.php.dist`und ergänze deine Einstellungen
5. Ersten deploy anstoßen. `dep deploy`
5. Auf dem Ziel-Server entweder das Documentroot oder einen Symlink auf `deployment/current/html/wp-core/`setzten.
6. WordPress installieren.

Auf dem Zeil-Server wird deployer unter `deployment` ein Verzeichniss `releases/[RELEASE_NR]` und einen Symlink `current`, der nach `releases/[RELEASE_NR]` zeigt anlegen. Nach dem deploy wird `current`wie folgt aussehen.
```
-rw-r--r--@  1 renereimann  staff  2853 13 Mai 06:43 wp-config.php
drwxr-xr-x   3 renereimann  staff   102 13 Mai 06:43 wp-content
drwxr-xr-x  22 renereimann  staff   748 13 Mai 06:43 wp-core
```

---

### Über mich
```
/**
 * Hallo, mein Name ist René Reimann
 *
 * ich bin WordPress Professional, ausgebildeter Mediengestalter für Digital- & Printmedien,
 * Webentwickler, Webdesigner, Podcaster, Berater, Ausbilder, Mitglied in der
 * IHK-Prüfkommission (Mediengestalter für Digital & Printmedien) kurzum
 * Senior Fullstack Developer und das allerbeste ein Vater & Ehemann.
 *
 * @author          Rene Reimann
 * @mail            info@rene-reimann.de
 * @phone           +49 171 83 66 824
 *
 * @twitter         https://twitter.com/DerPixler
 * @instagram       https://www.instagram.com/rene_reimann
 * @github          https://github.com/derpixler
 * @gist            https://gist.github.com
 * @WordPress       https://profiles.wordpress.org/derpixler
 * @Xing            https://www.xing.com/profile/Rene_Reimann
 * @WP_Sofa         https://wp-sofa.de
 * @Behance         https://www.behance.net/rene-reimann
 *
 **/
 ```

..
