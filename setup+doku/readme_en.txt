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

Copy the contents in the "copy_this"-folder into your oxid folder.

Execute the following SQL Script in your oxid database (tools menu in admin backend):

CREATE TABLE d3ce_online_users (
	id int(11) NOT NULL auto_increment,
	visitor varchar(100) default NULL,
	timevisit int(11) NOT NULL default '0',
	PRIMARY KEY (id)
) TYPE=MyISAM;

Add the Module to your Oxid Modules in the admin backend:

oxcmp_utils => d3ce_usersonline/views/d3ce_oxcmp_utils_usersonline

Now you can include the counter anywhere in your templates (e.g. _left.tpl)
You just need the following line:

[{include file="inc/d3ce_usersonline.tpl"}]

LEGAL NOTICE:

The users ip is never saved in your database, the ip will be hashed before it is stored.