CREATE TABLE d3usersonline (
    `id` int(11) NOT NULL auto_increment,
    `visitor` varchar(100) default NULL,
    `timevisit` int(11) NOT NULL default '0',
    `oxclass` varchar(32) collate latin1_general_ci NOT NULL,
    PRIMARY KEY (id)
) ENGINE=MyISAM;