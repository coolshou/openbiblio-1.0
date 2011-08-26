-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 26, 2011 at 08:29 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `openbibliowork`
--

-- --------------------------------------------------------

--
-- Table structure for table `usmarc_tag_dm`
--

CREATE TABLE IF NOT EXISTS `usmarc_tag_dm` (
  `block_nmbr` tinyint(4) NOT NULL DEFAULT '0',
  `tag` smallint(6) NOT NULL DEFAULT '0',
  `description` varchar(80) NOT NULL DEFAULT '',
  `ind1_description` varchar(80) NOT NULL DEFAULT '',
  `ind2_description` varchar(80) NOT NULL DEFAULT '',
  `repeatable_flg` char(1) NOT NULL DEFAULT '',
  PRIMARY KEY (`block_nmbr`,`tag`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usmarc_tag_dm`
--

INSERT INTO `usmarc_tag_dm` (`block_nmbr`, `tag`, `description`, `ind1_description`, `ind2_description`, `repeatable_flg`) VALUES
(0, 10, 'Library of congress control number', 'Undefined', 'Undefined', 'N'),
(0, 13, 'Patent control information', 'Undefined', 'Undefined', 'Y'),
(0, 15, 'National bibliography number', 'Undefined', 'Undefined', 'Y'),
(0, 16, 'National bibliographic agency control number', 'National bibliographic agency', 'Undefined', 'Y'),
(0, 17, 'Copyright or legal deposit number', 'Undefined', 'Undefined', 'Y'),
(0, 18, 'Copyright article-fee code', 'Undefined', 'Undefined', 'N'),
(0, 20, 'International standard book number', 'Undefined', 'Undefined', 'Y'),
(0, 22, 'International standard serial number', 'Level of international interest', 'Undefined', 'Y'),
(0, 24, 'Other standard identifier', 'Type of standard number or code', 'Difference indicator', 'Y'),
(0, 25, 'Overseas acquisition number', 'Undefined', 'Undefined', 'Y'),
(0, 27, 'Standard technical report number', 'Undefined', 'Undefined', 'Y'),
(0, 28, 'Publisher number', 'Type of publisher number', 'Note/added entry controller', 'Y'),
(0, 30, 'Coden designation', 'Undefined', 'Undefined', 'Y'),
(0, 32, 'Postal registration number', 'Undefined', 'Undefined', 'Y'),
(0, 33, 'Date/time and place of an event', 'Type of date in subfield $a', 'Type of event', 'Y'),
(0, 34, 'Coded cartographic mathematical data', 'Type of scale', 'Type of ring', 'Y'),
(0, 35, 'System control number', 'Undefined', 'Undefined', 'Y'),
(0, 36, 'Original study number for computer data files', 'Undefined', 'Undefined', 'N'),
(0, 37, 'Source of acquisition', 'Undefined', 'Undefined', 'Y'),
(0, 40, 'Cataloging source', 'Undefined', 'Undefined', 'N'),
(0, 41, 'Language code', 'Translation indication', 'Source of code', 'Y'),
(0, 42, 'Authentication code', 'Undefined', 'Undefined', 'N'),
(0, 43, 'Geographic area code', 'Undefined', 'Undefined', 'N'),
(0, 44, 'Country of publishing/producing entity code', 'Undefined', 'Undefined', 'N'),
(0, 45, 'Time period of content', 'Type of time period in subfield $b or $c', 'Undefined', 'N'),
(0, 46, 'Special coded dates', 'Undefined', 'Undefined', 'N'),
(0, 47, 'Form of musical composition code', 'Undefined', 'Undefined', 'N'),
(0, 48, 'Number of musical instruments or voices code', 'Undefined', 'Undefined', 'Y'),
(0, 50, 'Library of congress call number', 'Existence in LC collection', 'Source of call number', 'Y'),
(0, 51, 'Library of congress copy, issue, offprint statement', 'Undefined', 'Undefined', 'Y'),
(0, 52, 'Geographic classification', 'Code source', 'Undefined', 'Y'),
(0, 55, 'Classification numbers assigned in canada', 'Existence in NLC collection', 'Type, completeness, source of class/call number', 'Y'),
(0, 60, 'National library of medicine call number', 'Existence in NLM collection', 'Source of call number', 'Y'),
(0, 61, 'National library of medicine copy statement', 'Undefined', 'Undefined', 'Y'),
(0, 66, 'Character sets present', 'Undefined', 'Undefined', 'N'),
(0, 70, 'National agricultural library call number', 'Existence in NAL collection', 'Undefined', 'Y'),
(0, 71, 'National agricultural library copy statement', 'Undefined', 'Undefined', 'Y'),
(0, 72, 'Subject category code', 'Undefined', 'Code source', 'Y'),
(0, 74, 'Gpo item number', 'Undefined', 'Undefined', 'Y'),
(0, 80, 'Universal decimal classification number', 'Undefined', 'Undefined', 'Y'),
(0, 82, 'Dewey decimal classification number', 'Type of edition', 'Source of classification number', 'Y'),
(0, 84, 'Other classification number', 'Undefined', 'Undefined', 'Y'),
(0, 86, 'Government document classification number', 'Number source', 'Undefined', 'Y'),
(0, 88, 'Report number', 'Undefined', 'Undefined', 'Y'),
(0, 99, 'Call Number', 'undefined', 'undefined', 'N'),
(1, 100, 'Main entry--personal name', 'Type of personal name entry element', 'Undefined', 'N'),
(1, 110, 'Main entry--corporate name', 'Type of corporate name entry element', 'Undefined', 'N'),
(1, 111, 'Main entry--meeting name', 'Type of meeting name entry element', 'Undefined', 'N'),
(1, 130, 'Main entry--uniform title', 'Nonfiling characters', 'Undefined', 'N'),
(2, 210, 'Abbreviated title', 'Title added entry', 'Type', 'Y'),
(2, 222, 'Key title', 'Specifies whether variant title and/or added entry is required', 'Nonfiling characters', 'Y'),
(2, 240, 'Uniform title', 'Uniform title printed or displayed', 'Nonfiling characters', 'N'),
(2, 242, 'Translation of title by cataloging agency', 'Title added entry', 'Nonfiling characters', 'Y'),
(2, 243, 'Collective uniform title', 'Uniform title printed or displayed', 'Nonfiling characters', 'N'),
(2, 245, 'Title statement', 'Title added entry', 'Nonfiling characters', 'N'),
(2, 246, 'Varying form of title', 'Note/added entry controller', 'Type of title', 'Y'),
(2, 247, 'Former title or title variations', 'Title added entry', 'Note controller', 'Y'),
(2, 250, 'Edition statement', 'Undefined', 'Undefined', 'N'),
(2, 254, 'Musical presentation statement', 'Undefined', 'Undefined', 'N'),
(2, 255, 'Cartographic mathematical data', 'Undefined', 'Undefined', 'Y'),
(2, 256, 'Computer file characteristics', 'Undefined', 'Undefined', 'N'),
(2, 257, 'Country of producing entity for archival films', 'Undefined', 'Undefined', 'N'),
(2, 260, 'Publication, distribution, etc. (imprint)', 'Sequence of publishing statements', 'Undefined', 'Y'),
(2, 261, 'Imprint statement for films (pre-aacr 1 revised)  [local]', 'Undefined', 'Undefined', 'N'),
(2, 262, 'Imprint statement for sound recordings (pre-aacr 2)  [local]', 'Undefined', 'Undefined', 'N'),
(2, 263, 'Projected publication date', 'Undefined', 'Undefined', 'N'),
(2, 270, 'Address', 'Level', 'Type of address', 'Y'),
(3, 300, 'Physical description', 'Undefined', 'Undefined', 'Y'),
(3, 306, 'Playing time', 'Undefined', 'Undefined', 'N'),
(3, 307, 'Hours, etc.', 'Display constant controller', 'Undefined', 'Y'),
(3, 310, 'Current publication frequency', 'Undefined', 'Undefined', 'N'),
(3, 340, 'Physical medium', 'Undefined', 'Undefined', 'Y'),
(3, 342, 'Geospatial reference data', 'Geospatial reference dimension', 'Geospatial reference method', 'Y'),
(3, 343, 'Planar coordinate data', 'Undefined', 'Undefined', 'Y'),
(3, 351, 'Organization and arrangement of materials', 'Undefined', 'Undefined', 'Y'),
(3, 352, 'Digital graphic representation', 'Undefined', 'Undefined', 'Y'),
(3, 355, 'Security classification control', 'Controlled element', 'Undefined', 'Y'),
(3, 362, 'Dates of publication and/or sequential designation', 'Format of date', 'Undefined', 'Y'),
(4, 400, 'Series statement/added entry--personal name   [us-local]', 'Type of personal name entry element', 'Pronoun represents main entry', 'Y'),
(4, 410, 'Series statement/added entry--corporate name  [us-local]', 'Type of corporate name entry element', 'Pronoun represents main entry', 'Y'),
(4, 411, 'Series statement/added entry--meeting name  [us-local]', 'Type of meeting name entry element', 'Pronoun represents main entry', 'Y'),
(4, 440, 'Series statement/added entry--title', 'Undefined', 'Nonfiling characters', 'Y'),
(4, 490, 'Series statement', 'Specifies whether series is traced', 'Undefined', 'Y'),
(5, 500, 'General note', 'Undefined', 'Undefined', 'Y'),
(5, 501, 'With note', 'Undefined', 'Undefined', 'Y'),
(5, 502, 'Dissertation note', 'Undefined', 'Undefined', 'Y'),
(5, 504, 'Bibliography, etc. note', 'Undefined', 'Undefined', 'Y'),
(5, 505, 'Formatted contents note', 'Display constant controller', 'Level of content designation', 'Y'),
(5, 506, 'Restrictions on access note', 'Undefined', 'Undefined', 'Y'),
(5, 507, 'Scale note for graphic material', 'Undefined', 'Undefined', 'N'),
(5, 508, 'Creation/production credits note', 'Undefined', 'Undefined', 'Y'),
(5, 510, 'Citation/references note', 'Coverage/location in source', 'Undefined', 'Y'),
(5, 511, 'Participant or performer note', 'Display constant controller', 'Undefined', 'Y'),
(5, 513, 'Type of report and period covered note', 'Undefined', 'Undefined', 'Y'),
(5, 514, 'Data quality note', 'Undefined', 'Undefined', 'N'),
(5, 515, 'Numbering peculiarities note', 'Undefined', 'Undefined', 'Y'),
(5, 516, 'Type of computer file or data note', 'Display constant controller', 'Undefined', 'Y'),
(5, 518, 'Date/time and place of an event note', 'Undefined', 'Undefined', 'Y'),
(5, 520, 'Summary, etc.', 'Display constant controller', 'Undefined', 'Y'),
(5, 521, 'Target audience note', 'Display constant controller', 'Undefined', 'Y'),
(5, 522, 'Geographic coverage note', 'Display constant controller', 'Undefined', 'Y'),
(5, 524, 'Preferred citation of described materials note', 'Display constant controller', 'Undefined', 'Y'),
(5, 525, 'Supplement note', 'Undefined', 'Undefined', 'Y'),
(5, 526, 'Study program information note', 'Display constant controller', 'Undefined', 'Y'),
(5, 530, 'Additional physical form available note', 'Undefined', 'Undefined', 'Y'),
(5, 533, 'Reproduction note', 'Undefined', 'Undefined', 'Y'),
(5, 534, 'Original version note', 'Undefined', 'Undefined', 'Y'),
(5, 535, 'Location of originals/duplicates note', 'Additional information about custodian', 'Undefined', 'Y'),
(5, 536, 'Funding information note', 'Undefined', 'Undefined', 'Y'),
(5, 538, 'System details note', 'Undefined', 'Undefined', 'Y'),
(5, 540, 'Terms governing use and reproduction note', 'Undefined', 'Undefined', 'Y'),
(5, 541, 'Immediate source of acquisition note', 'Undefined', 'Undefined', 'Y'),
(5, 544, 'Location of other archival materials note', 'Relationship', 'Undefined', 'Y'),
(5, 545, 'Biographical or historical data', 'Type of data', 'Undefined', 'Y'),
(5, 546, 'Language note', 'Undefined', 'Undefined', 'Y'),
(5, 547, 'Former title complexity note', 'Undefined', 'Undefined', 'Y'),
(5, 550, 'Issuing body note', 'Undefined', 'Undefined', 'Y'),
(5, 552, 'Entity and attribute information note', 'Undefined', 'Undefined', 'Y'),
(5, 555, 'Cumulative index/finding aids note', 'Display constant controller', 'Undefined', 'Y'),
(5, 556, 'Information about documentation note', 'Display constant controller', 'Undefined', 'Y'),
(5, 561, 'Ownership and custodial history', 'Undefined', 'Undefined', 'Y'),
(5, 562, 'Copy and version identification note', 'Undefined', 'Undefined', 'Y'),
(5, 565, 'Case file characteristics note', 'Display constant controller', 'Undefined', 'Y'),
(5, 567, 'Methodology note', 'Display constant controller', 'Undefined', 'Y'),
(5, 580, 'Linking entry complexity note', 'Undefined', 'Undefined', 'Y'),
(5, 581, 'Publications about described materials note', 'Display constant controller', 'Undefined', 'Y'),
(5, 583, 'Action note', 'Undefined', 'Undefined', 'Y'),
(5, 584, 'Accumulation and frequency of use note', 'Undefined', 'Undefined', 'Y'),
(5, 585, 'Exhibitions note', 'Undefined', 'Undefined', 'Y'),
(5, 586, 'Awards note', 'Display constant controller', 'Undefined', 'Y'),
(6, 600, 'Subject added entry--personal name', 'Type of personal name entry element', 'Thesaurus', 'Y'),
(6, 610, 'Subject added entry--corporate name', 'Type of corporate name entry element', 'Thesaurus', 'Y'),
(6, 611, 'Subject added entry--meeting name', 'Type of meeting name entry element', 'Thesaurus', 'Y'),
(6, 630, 'Subject added entry--uniform title', 'Nonfiling characters', 'Thesaurus', 'Y'),
(6, 650, 'Subject added entry--topical term', 'Level of subject', 'Thesaurus', 'Y'),
(6, 651, 'Subject added entry--geographic name', 'Undefined', 'Thesaurus', 'Y'),
(6, 653, 'Index term--uncontrolled', 'Level of index term', 'Undefined', 'Y'),
(6, 654, 'Subject added entry--faceted topical terms', 'Level of subject', 'Undefined', 'Y'),
(6, 655, 'Index term--genre/form', 'Type of heading', 'Source of term', 'Y'),
(6, 656, 'Index term--occupation', 'Undefined', 'Source of term', 'Y'),
(6, 657, 'Index term--function', 'Undefined', 'Source of term', 'Y'),
(6, 658, 'Index term--curriculum objective', 'Undefined', 'Undefined', 'Y'),
(7, 700, 'Added entry--personal name', 'Type of personal name entry element', 'Type of added entry', 'Y'),
(7, 710, 'Added entry--corporate name', 'Type of corporate name entry element', 'Type of added entry', 'Y'),
(7, 711, 'Added entry--meeting name', 'Type of meeting name entry element', 'Type of added entry', 'Y'),
(7, 720, 'Added entry--uncontrolled name', 'Type of name', 'Undefined', 'Y'),
(7, 730, 'Added entry--uniform title', 'Nonfiling characters', 'Type of added entry', 'Y'),
(7, 740, 'Added entry--uncontrolled related/analytical title', 'Nonfiling characters', 'Type of added entry', 'Y'),
(7, 752, 'Added entry--hierarchical place name', 'Undefined', 'Undefined', 'Y'),
(7, 753, 'System details access to computer files', 'Undefined', 'Undefined', 'Y'),
(7, 754, 'Added entry--taxonomic identification', 'Undefined', 'Undefined', 'Y'),
(7, 760, 'Main series entry', 'Note controller', 'Display constant controller', 'Y'),
(7, 762, 'Subseries entry', 'Note controller', 'Display constant controller', 'Y'),
(7, 765, 'Original language entry', 'Note controller', 'Display constant controller', 'Y'),
(7, 767, 'Translation entry', 'Note controller', 'Display constant controller', 'Y'),
(7, 770, 'Supplement/special issue entry', 'Note controller', 'Display constant controller', 'Y'),
(7, 772, 'Supplement parent entry', 'Note controller', 'Display constant controller', 'Y'),
(7, 773, 'Host item entry', 'Note controller', 'Display constant controller', 'Y'),
(7, 774, 'Constituent unit entry', 'Note controller', 'Display constant controller', 'Y'),
(7, 775, 'Other edition entry', 'Note controller', 'Display constant controller', 'Y'),
(7, 776, 'Additional physical form entry', 'Note controller', 'Display constant controller', 'Y'),
(7, 777, 'Issued with entry', 'Note controller', 'Display constant controller', 'Y'),
(7, 780, 'Preceding entry', 'Note controller', 'Type of relationship', 'Y'),
(7, 785, 'Succeeding entry', 'Note controller', 'Type of relationship', 'Y'),
(7, 786, 'Data source entry', 'Note controller', 'Display constant controller', 'Y'),
(7, 787, 'Nonspecific relationship entry', 'Note controller', 'Display constant controller', 'Y'),
(8, 800, 'Series added entry--personal name', 'Type of personal name entry element', 'Undefined', 'Y'),
(8, 810, 'Series added entry--corporate name', 'Type of corporate name entry element', 'Undefined', 'Y'),
(8, 811, 'Series added entry--meeting name', 'Type of meeting name entry element', 'Undefined', 'Y'),
(8, 830, 'Series added entry--uniform title', 'Undefined', 'Nonfiling characters', 'Y'),
(8, 850, 'Holding institution', 'Undefined', 'Undefined', 'Y'),
(8, 852, 'Location', 'Shelving scheme', 'Shelving order', 'Y'),
(8, 856, 'Electronic location and access', 'Access method', 'Relationship', 'Y'),
(8, 880, 'Alternate graphic representation', 'Same as associated field', 'Same as associated field', 'Y'),
(8, 886, 'Foreign marc information field', 'Type of field', 'Undefined', 'Y'),
(8, 887, 'Non-marc information field', 'Undefined', 'Undefined', 'Y');
