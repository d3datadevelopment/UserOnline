Authors: Aggrosoft it intelligence, D3 Data Development

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

-----------------------------------------------------------------------

Installation:

Kopieren Sie die Inhalte des "copy_this"-Ordner in Ihr Shop-Verzeichnis,

Führen Sie folgendes Script in Ihrer Datenbank aus:

CREATE TABLE d3usersonline (
    `id` int(11) NOT NULL auto_increment,
    `visitor` varchar(100) default NULL,
    `timevisit` int(11) NOT NULL default '0',
    `oxclass` varchar(32) collate latin1_general_ci NOT NULL,
    PRIMARY KEY (id)
) TYPE=MyISAM;

Fügen Sie nun das Modul zu Ihrem Shop hinzu:

oxcmp_utils => d3usersonline/views/d3_oxcmp_utils_usersonline

Sie können den counter nun in eines Ihrer Templates einbauen (evtl. _left.tpl)
Hierfür benötigen Sie lediglich folgende Zeile:

[{include file="inc/d3ce_usersonline.tpl"}]

HINWEIS:

Da nach deutschem Recht nicht einfach irgendwelche IP's in der DB abgespeichert werden
dürfen und Sie auch sicherlich kein Interesse an den IP's haben wird aus der User IP
ein Hash errechnet und dieser zum Vergleich herangezogen und gespeichert.
