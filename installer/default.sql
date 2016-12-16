--
-- Table structure for table `ts_categories`
--

CREATE TABLE IF NOT EXISTS `ts_categories` (
  `cate_id` int(11) NOT NULL,
  `cate_name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `cate_urlname` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `cate_status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_country`
--

CREATE TABLE IF NOT EXISTS `ts_country` (
  `countryId` int(11) NOT NULL,
  `countryName` varchar(32) DEFAULT NULL,
  `countryCode` varchar(4) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=242 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ts_country`
--

INSERT INTO `ts_country` (`countryId`, `countryName`, `countryCode`) VALUES
(2, 'Afghanistan', 'AF'),
(3, 'Albania', 'AL'),
(4, 'Algeria', 'DZ'),
(5, 'American Samoa', 'AS'),
(6, 'Andorra', 'AD'),
(7, 'Angola', 'AO'),
(8, 'Anguilla', 'AI'),
(9, 'Antarctica', 'AQ'),
(10, 'Antigua and Barbuda', 'AG'),
(11, 'Argentina', 'AR'),
(12, 'Armenia', 'AM'),
(13, 'Aruba', 'AW'),
(14, 'Australia', 'AU'),
(15, 'Austria', 'AT'),
(16, 'Azerbaijan', 'AZ'),
(17, 'Bahamas', 'BS'),
(18, 'Bahrain', 'BH'),
(19, 'Bangladesh', 'BD'),
(20, 'Barbados', 'BB'),
(21, 'Belarus', 'BY'),
(22, 'Belgium', 'BE'),
(23, 'Belize', 'BZ'),
(24, 'Benin', 'BJ'),
(25, 'Bermuda', 'BM'),
(26, 'Bhutan', 'BT'),
(27, 'Bolivia', 'BO'),
(28, 'Bosnia and Herzegovina', 'BA'),
(29, 'Botswana', 'BW'),
(30, 'Brazil', 'BR'),
(31, 'British Indian Ocean Territory', 'IO'),
(32, 'British Virgin Islands', 'VG'),
(33, 'Brunei', 'BN'),
(34, 'Bulgaria', 'BG'),
(35, 'Burkina Faso', 'BF'),
(36, 'Burundi', 'BI'),
(37, 'Cambodia', 'KH'),
(38, 'Cameroon', 'CM'),
(39, 'Canada', 'CA'),
(40, 'Cape Verde', 'CV'),
(41, 'Cayman Islands', 'KY'),
(42, 'Central African Republic', 'CF'),
(43, 'Chad', 'TD'),
(44, 'Chile', 'CL'),
(45, 'China', 'CN'),
(46, 'Christmas Island', 'CX'),
(47, 'Cocos Islands', 'CC'),
(48, 'Colombia', 'CO'),
(49, 'Comoros', 'KM'),
(50, 'Cook Islands', 'CK'),
(51, 'Costa Rica', 'CR'),
(52, 'Croatia', 'HR'),
(53, 'Cuba', 'CU'),
(54, 'Curacao', 'CW'),
(55, 'Cyprus', 'CY'),
(56, 'Czech Republic', 'CZ'),
(57, 'Democratic Republic of the Congo', 'CD'),
(58, 'Denmark', 'DK'),
(59, 'Djibouti', 'DJ'),
(60, 'Dominica', 'DM'),
(61, 'Dominican Republic', 'DO'),
(62, 'East Timor', 'TL'),
(63, 'Ecuador', 'EC'),
(64, 'Egypt', 'EG'),
(65, 'El Salvador', 'SV'),
(66, 'Equatorial Guinea', 'GQ'),
(67, 'Eritrea', 'ER'),
(68, 'Estonia', 'EE'),
(69, 'Ethiopia', 'ET'),
(70, 'Falkland Islands', 'FK'),
(71, 'Faroe Islands', 'FO'),
(72, 'Fiji', 'FJ'),
(73, 'Finland', 'FI'),
(74, 'France', 'FR'),
(75, 'French Polynesia', 'PF'),
(76, 'Gabon', 'GA'),
(77, 'Gambia', 'GM'),
(78, 'Georgia', 'GE'),
(79, 'Germany', 'DE'),
(80, 'Ghana', 'GH'),
(81, 'Gibraltar', 'GI'),
(82, 'Greece', 'GR'),
(83, 'Greenland', 'GL'),
(84, 'Grenada', 'GD'),
(85, 'Guam', 'GU'),
(86, 'Guatemala', 'GT'),
(87, 'Guernsey', 'GG'),
(88, 'Guinea', 'GN'),
(89, 'Guinea-Bissau', 'GW'),
(90, 'Guyana', 'GY'),
(91, 'Haiti', 'HT'),
(92, 'Honduras', 'HN'),
(93, 'Hong Kong', 'HK'),
(94, 'Hungary', 'HU'),
(95, 'Iceland', 'IS'),
(96, 'India', 'IN'),
(97, 'Indonesia', 'ID'),
(98, 'Iran', 'IR'),
(99, 'Iraq', 'IQ'),
(100, 'Ireland', 'IE'),
(101, 'Isle of Man', 'IM'),
(102, 'Israel', 'IL'),
(103, 'Italy', 'IT'),
(104, 'Ivory Coast', 'CI'),
(105, 'Jamaica', 'JM'),
(106, 'Japan', 'JP'),
(107, 'Jersey', 'JE'),
(108, 'Jordan', 'JO'),
(109, 'Kazakhstan', 'KZ'),
(110, 'Kenya', 'KE'),
(111, 'Kiribati', 'KI'),
(112, 'Kosovo', 'XK'),
(113, 'Kuwait', 'KW'),
(114, 'Kyrgyzstan', 'KG'),
(115, 'Laos', 'LA'),
(116, 'Latvia', 'LV'),
(117, 'Lebanon', 'LB'),
(118, 'Lesotho', 'LS'),
(119, 'Liberia', 'LR'),
(120, 'Libya', 'LY'),
(121, 'Liechtenstein', 'LI'),
(122, 'Lithuania', 'LT'),
(123, 'Luxembourg', 'LU'),
(124, 'Macao', 'MO'),
(125, 'Macedonia', 'MK'),
(126, 'Madagascar', 'MG'),
(127, 'Malawi', 'MW'),
(128, 'Malaysia', 'MY'),
(129, 'Maldives', 'MV'),
(130, 'Mali', 'ML'),
(131, 'Malta', 'MT'),
(132, 'Marshall Islands', 'MH'),
(133, 'Mauritania', 'MR'),
(134, 'Mauritius', 'MU'),
(135, 'Mayotte', 'YT'),
(136, 'Mexico', 'MX'),
(137, 'Micronesia', 'FM'),
(138, 'Moldova', 'MD'),
(139, 'Monaco', 'MC'),
(140, 'Mongolia', 'MN'),
(141, 'Montenegro', 'ME'),
(142, 'Montserrat', 'MS'),
(143, 'Morocco', 'MA'),
(144, 'Mozambique', 'MZ'),
(145, 'Myanmar', 'MM'),
(146, 'Namibia', 'NA'),
(147, 'Nauru', 'NR'),
(148, 'Nepal', 'NP'),
(149, 'Netherlands', 'NL'),
(150, 'Netherlands Antilles', 'AN'),
(151, 'New Caledonia', 'NC'),
(152, 'New Zealand', 'NZ'),
(153, 'Nicaragua', 'NI'),
(154, 'Niger', 'NE'),
(155, 'Nigeria', 'NG'),
(156, 'Niue', 'NU'),
(157, 'North Korea', 'KP'),
(158, 'Northern Mariana Islands', 'MP'),
(159, 'Norway', 'NO'),
(160, 'Oman', 'OM'),
(161, 'Pakistan', 'PK'),
(162, 'Palau', 'PW'),
(163, 'Palestine', 'PS'),
(164, 'Panama', 'PA'),
(165, 'Papua New Guinea', 'PG'),
(166, 'Paraguay', 'PY'),
(167, 'Peru', 'PE'),
(168, 'Philippines', 'PH'),
(169, 'Pitcairn', 'PN'),
(170, 'Poland', 'PL'),
(171, 'Portugal', 'PT'),
(172, 'Puerto Rico', 'PR'),
(173, 'Qatar', 'QA'),
(174, 'Republic of the Congo', 'CG'),
(175, 'Reunion', 'RE'),
(176, 'Romania', 'RO'),
(177, 'Russia', 'RU'),
(178, 'Rwanda', 'RW'),
(179, 'Saint Barthelemy', 'BL'),
(180, 'Saint Helena', 'SH'),
(181, 'Saint Kitts and Nevis', 'KN'),
(182, 'Saint Lucia', 'LC'),
(183, 'Saint Martin', 'MF'),
(184, 'Saint Pierre and Miquelon', 'PM'),
(185, 'Saint Vincent and the Grenadines', 'VC'),
(186, 'Samoa', 'WS'),
(187, 'San Marino', 'SM'),
(188, 'Sao Tome and Principe', 'ST'),
(189, 'Saudi Arabia', 'SA'),
(190, 'Senegal', 'SN'),
(191, 'Serbia', 'RS'),
(192, 'Seychelles', 'SC'),
(193, 'Sierra Leone', 'SL'),
(194, 'Singapore', 'SG'),
(195, 'Sint Maarten', 'SX'),
(196, 'Slovakia', 'SK'),
(197, 'Slovenia', 'SI'),
(198, 'Solomon Islands', 'SB'),
(199, 'Somalia', 'SO'),
(200, 'South Africa', 'ZA'),
(201, 'South Korea', 'KR'),
(202, 'South Sudan', 'SS'),
(203, 'Spain', 'ES'),
(204, 'Sri Lanka', 'LK'),
(205, 'Sudan', 'SD'),
(206, 'Suriname', 'SR'),
(207, 'Svalbard and Jan Mayen', 'SJ'),
(208, 'Swaziland', 'SZ'),
(209, 'Sweden', 'SE'),
(210, 'Switzerland', 'CH'),
(211, 'Syria', 'SY'),
(212, 'Taiwan', 'TW'),
(213, 'Tajikistan', 'TJ'),
(214, 'Tanzania', 'TZ'),
(215, 'Thailand', 'TH'),
(216, 'Togo', 'TG'),
(217, 'Tokelau', 'TK'),
(218, 'Tonga', 'TO'),
(219, 'Trinidad and Tobago', 'TT'),
(220, 'Tunisia', 'TN'),
(221, 'Turkey', 'TR'),
(222, 'Turkmenistan', 'TM'),
(223, 'Turks and Caicos Islands', 'TC'),
(224, 'Tuvalu', 'TV'),
(225, 'U.S. Virgin Islands', 'VI'),
(226, 'Uganda', 'UG'),
(227, 'Ukraine', 'UA'),
(228, 'United Arab Emirates', 'AE'),
(229, 'United Kingdom', 'GB'),
(230, 'United States', 'US'),
(231, 'Uruguay', 'UY'),
(232, 'Uzbekistan', 'UZ'),
(233, 'Vanuatu', 'VU'),
(234, 'Vatican', 'VA'),
(235, 'Venezuela', 'VE'),
(236, 'Vietnam', 'VN'),
(237, 'Wallis and Futuna', 'WF'),
(238, 'Western Sahara', 'EH'),
(239, 'Yemen', 'YE'),
(240, 'Zambia', 'ZM'),
(241, 'Zimbabwe', 'ZW');

-- --------------------------------------------------------

--
-- Table structure for table `ts_downloadtbl`
--

CREATE TABLE IF NOT EXISTS `ts_downloadtbl` (
  `download_id` int(11) NOT NULL,
  `download_uid` int(11) NOT NULL,
  `download_pid` int(11) NOT NULL,
  `download_planid` int(11) NOT NULL,
  `download_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_emaillist`
--

CREATE TABLE IF NOT EXISTS `ts_emaillist` (
  `e_id` int(11) NOT NULL,
  `e_email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `e_list` text COLLATE utf8_unicode_ci NOT NULL,
  `e_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `e_date` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_emailproviders`
--

CREATE TABLE IF NOT EXISTS `ts_emailproviders` (
  `ep_id` int(11) NOT NULL,
  `ep_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ep_credentials` text COLLATE utf8_unicode_ci NOT NULL,
  `ep_status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_eplist`
--

CREATE TABLE IF NOT EXISTS `ts_eplist` (
  `eplist_id` int(11) NOT NULL,
  `eplist_parentid` int(11) NOT NULL,
  `eplist_uniqid` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `eplist_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `eplist_use` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_language`
--

CREATE TABLE IF NOT EXISTS `ts_language` (
  `language_id` int(11) NOT NULL,
  `language_key` text COLLATE utf8_unicode_ci NOT NULL,
  `language_type` text COLLATE utf8_unicode_ci NOT NULL,
  `language_english` text COLLATE utf8_unicode_ci NOT NULL,
  `language_french` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=157 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ts_language`
--

INSERT INTO `ts_language` (`language_id`, `language_key`, `language_type`, `language_english`, `language_french`) VALUES
(1, 'login', 'title', 'Themeportal - Login Page', 'Themeportal - Page de connexion'),
(2, 'register', 'title', 'Themeportal - Register Page', 'Themeportal - Inscrire page'),
(3, 'forgotpwd', 'title', 'Themeportal - Forgot Password Page', 'Themeportal - Mot de passe oubliÃƒÂ© page'),
(4, 'resetpwd', 'title', 'Themeportal - Reset Password Page', 'Themeportal - RÃƒÂ©initialiser page Mot de passe'),
(5, 'email', 'message', 'Email should be correct.', 'Email devrait ÃƒÂªtre correcte.'),
(6, 'empty', 'message', 'All fields are Required', 'Tous les champs sont requis'),
(7, 'password', 'message', 'Password should contain minimum 7 characters.', 'Mot de passe doit contenir un minimum de 7 caractÃƒÂ¨res.'),
(8, 'repassword', 'message', 'Both passwords should be same.', 'Les deux mots de passe doivent ÃƒÂªtre identiques.'),
(9, 'loginsuc', 'message', 'Successfully logged in.', 'RÃƒÂ©ussir connectÃƒÂ©.'),
(10, 'forgotpassword', 'message', 'Please, check your email for the forgot password link.', 'S''il vous plaÃƒÂ®t , vÃƒÂ©rifiez votre email pour le lien Mot de passe oubliÃƒÂ© .'),
(11, 'activateerror', 'message', 'Please, activate your account.', 'S''il vous plaÃƒÂ®t , activer votre compte.'),
(12, 'blockederror', 'message', 'Contact support, your account is blocked.', 'Contactez le support , votre compte est bloquÃƒÂ©.'),
(13, 'loginerror', 'message', 'Login details are incorrect.', 'Les informations de connexion sont incorrectes .'),
(14, 'forgotpwderror', 'message', 'This detail is not with us.', 'Ce dÃƒÂ©tail est pas avec nous .'),
(15, 'resetpwdsuc', 'message', 'Password changed successfully.', 'Le mot de passe a ÃƒÂ©tÃƒÂ© changÃƒÂ© avec succÃƒÂ¨s.'),
(17, 'bannerheading', 'homepage', 'YOU ARE THEME CREATOR', 'VOUS ÃƒÅ TES THEME CREATOR'),
(16, 'registersuc', 'message', 'Please, check your email for activation link.', 'S''il vous plaÃƒÂ®t , vÃƒÂ©rifiez votre email pour le lien d''activation '),
(18, 'bannersubheading', 'homepage', 'Brought to you by the largest global community of creatives.', 'Offert ÃƒÂ  vous par la plus grande communautÃƒÂ© mondiale de crÃƒÂ©atifs '),
(19, 'searchplaceholder', 'homepage', 'Type here to search a theme', 'Tapez ici pour rechercher un thÃƒÂ¨me'),
(20, 'searchtext', 'homepage', 'Search', 'Chercher'),
(21, 'topbutton', 'homepage', 'browse newest theme', 'parcourir le plus rÃƒÂ©cent thÃƒÂ¨me'),
(22, 'featuredbox', 'homepage', 'FEATURED', 'VEDETTE\r\n'),
(23, 'buynowtab', 'homepage', 'buy now', 'Acheter maintenant'),
(24, 'livedemotab', 'homepage', 'live demo', '\r\ndÃƒÂ©monstration en direct'),
(25, 'ourlatestthemetext', 'homepage', 'OUR LATEST THEME', '\r\nNOS DERNIERES THÃƒË†ME'),
(26, 'latestsubheading', 'homepage', 'Get the best themes in the market', 'Trouvez les meilleurs thÃƒÂ¨mes du marchÃƒÂ©'),
(28, 'ourclientsaystext', 'homepage', 'OUR CLIENTS SAYS', '\r\nNOS CLIENTS DIT'),
(29, 'ourclientssubtext', 'homepage', 'What satisfied customer says', 'Qu''est-ce que dit client satisfait'),
(30, 'newsletterheading', 'homepage', 'SUBSCRIBE TO OUR NEWSLETTER', 'ABONNEZ-VOUS Ãƒâ‚¬ NOTRE NEWSLETTER'),
(31, 'newslettersubheading', 'homepage', 'Subscribe to our newsletter for Latest News, Updates, Template directly in your inbox', 'Abonnez-vous ÃƒÂ  notre newsletter pour DerniÃƒÂ¨res Nouvelles , mises ÃƒÂ  jour , modÃƒÂ¨le directement dans votre boÃƒÂ®te de rÃƒÂ©ception'),
(32, 'newsletterplaceholder', 'homepage', 'Enter your mail address', 'Entrez votre adresse e-mail\r\n'),
(33, 'newsletterbutton', 'homepage', 'subscribe today', 'abonnez-vous dÃƒÂ¨s aujourd''hui'),
(34, 'newsletterinfo', 'homepage', 'We don''t share any of your information to others', 'Nous ne partageons pas vos informations ÃƒÂ  d''autres\r\n'),
(35, 'pricetext', 'singleproductpage', 'PRICE', 'PRIX'),
(36, 'ratingstext', 'singleproductpage', 'RATINGS', 'COTES'),
(37, 'likestext', 'singleproductpage', 'LIKES', 'AIME'),
(38, 'formate', 'singleproductpage', 'FORMATE', 'FORMAT'),
(39, 'licenseheading', 'singleproductpage', 'LICENSE OF USE', 'LICENCE D''UTILISATION'),
(40, 'licensesubheading', 'singleproductpage', 'You can use it for personal or commercial projects. You can''t resell it partially or in this form.', 'Vous pouvez l''utiliser pour des projets personnels ou commerciaux . Vous ne pouvez pas revendre partiellement ou sous cette forme.'),
(41, 'buynowbutton', 'singleproductpage', 'Buy Now', 'Acheter maintenant'),
(42, 'livedemobutton', 'singleproductpage', 'Live Demo', 'dÃƒÂ©monstration en direct'),
(43, 'productheading', 'singleproductpage', 'PRODUCT INFO', 'INFORMATION SUR LE PRODUIT'),
(44, 'createsubheading', 'singleproductpage', 'Create Date', 'crÃƒÂ©er un rendez-vous'),
(45, 'downloadssubheading', 'singleproductpage', 'Downloads', 'TÃƒÂ©lÃƒÂ©chargements'),
(46, 'updateddatetext', 'singleproductpage', 'Updated Date', ' date de mise ÃƒÂ  jour'),
(47, 'ratingssubheading', 'singleproductpage', 'Ratings', 'ÃƒÂ©valuations'),
(48, 'responsivesubheading', 'singleproductpage', 'Responsive', 'Sensible'),
(49, 'formatsubheading', 'singleproductpage', 'Format', 'Format'),
(50, 'documentssubheading', 'singleproductpage', 'Documents', 'Documents'),
(51, 'relatedheading', 'singleproductpage', 'RELATED PRODUCTS', 'PRODUITS CONNEXES'),
(52, 'username', 'message', 'Username should not contain any special characters and should be not more that 10 characters.', 'Nom d''utilisateur ne doit pas contenir de caractÃƒÂ¨res spÃƒÂ©ciaux et ne devrait pas ÃƒÂªtre plus que 10 caractÃƒÂ¨res .'),
(53, 'usernameexists', 'message', 'Username is already taken. Please, try again.', 'Nom d''utilisateur dÃƒÂ©jÃƒÂ  pris. Veuillez rÃƒÂ©essayer.'),
(54, 'alltext', 'homepage', 'All', 'Tout'),
(55, 'newslettersuc', 'message', 'Thank you for subscribing.', 'Merci de vous ÃƒÂªtre abonnÃƒÂ©.'),
(56, 'newslettererr', 'message', 'Oops : Something went wrong. Please, try again.', 'Oops : Quelque chose a mal tournÃƒÂ©. Veuillez rÃƒÂ©essayer.'),
(57, 'selectproduct', 'homepage', 'Select product', 'Choisir le produit'),
(58, 'pricetblbutton', 'commontext', 'Take this plan', 'Prenez ce plan'),
(99, 'sendtext', 'commontext', 'Send', 'Envoyer'),
(60, 'removeframe', 'commontext', 'Remove iframe', ' Retirer iframe'),
(61, 'signuptext', 'commontext', 'SignUp', 'S''inscrire'),
(62, 'logintext', 'commontext', 'Login', 'S''identifier'),
(63, 'logouttext', 'commontext', 'Logout', 'Se dÃƒÂ©connecter'),
(64, 'relatedprodtext', 'commontext', 'Related Products', 'Produits connexes'),
(65, 'searchrestext', 'commontext', 'Search result', 'RÃƒÂ©sultat de la recherche'),
(66, 'checkoutheading', 'commontext', 'Checkout Page', ' Commander page'),
(67, 'continueshopbtn', 'commontext', 'Continue Shopping', 'Continuer vos achats'),
(68, 'checkoutbtn', 'commontext', 'Checkout', 'Check-out'),
(69, 'plannametext', 'commontext', 'Product', 'Produit'),
(70, 'amounttext', 'commontext', 'Amount', 'Montant'),
(71, 'canceltext', 'commontext', 'Cancel', 'Annuler'),
(72, 'paymentboxheading', 'commontext', 'Click proceed to initiate payment', 'Cliquez sur Continuer pour lancer le paiement'),
(73, 'paymentboxbtn', 'commontext', 'Proceed', 'ProcÃƒÂ©der'),
(74, 'emptycart', 'message', 'Cart is empty, please choose products.', 'Le panier est vide , s''il vous plaÃƒÂ®t choisir les produits .'),
(75, 'payCanceledHeading', 'commontext', 'Transaction Cancelled', 'Transaction AnnulÃƒÂ©'),
(76, 'payCancelh3', 'commontext', 'Oops , you canceled payment.', 'Oops , vous avez annulÃƒÂ© le paiement .'),
(77, 'payCanceltext', 'commontext', 'You have canceled the payment, but don''''t worry the products are still in your cart. You can purchase them any time you want.', 'Vous avez annulÃ© le paiement , mais don''''t inquiÃ¨tent les produits sont toujours dans votre panier . Vous pouvez les acheter Ã  tout moment.'),
(80, 'freetext', 'commontext', 'Free', 'Gratuit'),
(81, 'upgradebtn', 'commontext', 'Upgrade', 'Surclassement'),
(82, 'contactsuc', 'message', 'Thank you. We will get back to you in 24 hours.', '\r\nJe vous remercie. Nous reviendrons vers vous dans les 24 heures .'),
(83, 'hometext', 'menus', 'Home', 'Accueil'),
(84, 'abouttext', 'menus', 'About Us', 'Ãƒâ‚¬ propos de nous'),
(85, 'producttext', 'menus', 'Products', 'Produits'),
(86, 'freetext', 'menus', 'Free', 'Gratuit'),
(87, 'paidtext', 'menus', 'Paid', 'PayÃƒÂ©'),
(88, 'plantext', 'menus', 'Plans', ' Des plans'),
(89, 'contacttext', 'menus', 'Contact', 'Contact'),
(90, 'dashboardtext', 'menus', 'Dashboard', 'Tableau de bord'),
(91, 'supporttext', 'menus', 'Support', 'Soutien'),
(92, 'privacytext', 'menus', 'Privacy policy', 'Politique de confidentialitÃƒÂ©'),
(93, 'tnctext', 'menus', 'Terms and Conditions', 'Termes et conditions'),
(94, 'paiddowntext', 'menus', 'Paid Downloads', 'TÃƒÂ©lÃƒÂ©chargements payÃƒÂ©s'),
(95, 'freedowntext', 'menus', 'Free Downloads ', 'TÃƒÂ©lÃƒÂ©chargements gratuits'),
(96, 'substext', 'menus', 'Add / Renew Subscription', 'Ajouter / Renouveler Abonnement'),
(97, 'profiletext', 'menus', 'Profile', 'Profil'),
(98, 'salestext', 'commontext', 'Sales', 'Ventes'),
(100, 'headingsupporttext', 'commontext', 'We are here to help you.', 'Nous sommes lÃƒÂ  pour vous aider.'),
(101, 'waittext', 'commontext', 'Wait', 'Attendez'),
(102, 'logusernametext', 'authentication', 'Username or Email', 'Nom d''utilisateur ou email'),
(103, 'logpwdtext', 'authentication', 'Password', 'Mot de passe'),
(104, 'logremembertext', 'authentication', 'Remember me', 'Souviens-toi de moi'),
(105, 'logforgotpwdtext', 'authentication', 'Forgot password ?', 'Mot de passe oubliÃƒÂ© ?'),
(106, 'logbottomtext', 'authentication', 'Don''t have account with Us,', 'Ne pas avoir un compte avec nous ,'),
(107, 'logbottomhreftext', 'authentication', 'Get one now.', 'Obtenez un maintenant.'),
(108, 'backtohometext', 'authentication', 'Back to home', 'De retour ÃƒÂ  la maison'),
(109, 'regusernametext', 'authentication', 'Username', 'Nom d''utilisateur'),
(110, 'regemailtext', 'authentication', 'Email', 'Email'),
(111, 'regbottomtext', 'authentication', 'Already have an account,', 'Vous avez dÃƒÂ©jÃƒÂ  un compte,'),
(112, 'regbottomhreftext', 'authentication', 'Get in now.', 'Entrez maintenant.'),
(113, 'fgpwdinputtext', 'authentication', 'Just enter username or email', 'Il suffit d''entrer le nom d''utilisateur ou e-mail'),
(114, 'submittext', 'authentication', 'Submit', 'Soumettre'),
(115, 'logconfirmpwdtext', 'authentication', 'Confirm Password', 'Confirmez le mot de passe'),
(116, 'producttext', 'userdashboard', 'Product', 'Produit'),
(117, 'datetext', 'userdashboard', 'Date', 'Date'),
(118, 'purchasecodetext', 'userdashboard', 'Purchase Code', 'code d''Achat'),
(119, 'downloadtext', 'userdashboard', 'Download', 'TÃƒÂ©lÃƒÂ©charger'),
(120, 'emptyproducttext', 'userdashboard', 'You have not purchased any product yet.', 'Vous ne l''avez pas encore achetÃƒÂ© un produit quelconque.'),
(121, 'freeprodtext', 'userdashboard', 'Free Products', 'Produits gratuits'),
(122, 'previewtext', 'userdashboard', 'Preview', 'AperÃƒÂ§u'),
(123, 'emptyfreetext', 'userdashboard', 'There are no freebies.', 'Il n''y a pas freebies .'),
(124, 'profilesucc', 'userdashboard', 'Details updated successfully.', 'DÃƒÂ©tails mis ÃƒÂ  jour avec succÃƒÂ¨s .'),
(125, 'profilepwdsucc', 'userdashboard', 'Password updated successfully.', 'Mot de passe mis ÃƒÂ  jour avec succÃƒÂ¨s .'),
(126, 'profilepwderr', 'userdashboard', 'Password should contain minimum 7 characters.', 'Mot de passe doit contenir un minimum de 7 caractÃƒÂ¨res.'),
(127, 'profilepwdmatcherr', 'userdashboard', 'Password doesn''t match.', 'Mot de passe ne correspond pas.'),
(128, 'usernametext', 'userdashboard', 'User Name', 'Nom d''utilisateur'),
(129, 'emailtext', 'userdashboard', 'Email', 'Email'),
(130, 'fnametext', 'userdashboard', 'First Name', 'PrÃƒÂ©nom'),
(131, 'lnametext', 'userdashboard', 'Last Name', 'Nom de famille'),
(132, 'updatebtntext', 'userdashboard', 'Update', 'Mettre ÃƒÂ  jour'),
(133, 'basicheadingtext', 'userdashboard', 'basic information', 'information basique'),
(134, 'billingheadingtext', 'userdashboard', 'billing information', 'dÃƒÂ©tails de facturation'),
(135, 'pwdheadingtext', 'userdashboard', 'change password', 'changer le mot de passe'),
(136, 'passwordtext', 'userdashboard', 'Password', 'Mot de passe'),
(137, 'resetpwdtext', 'userdashboard', 'reset password', 'rÃƒÂ©initialiser le mot de passe'),
(138, 'mobiletext', 'userdashboard', 'Mobile', 'Mobile'),
(139, 'addtext', 'userdashboard', 'Address', 'Adresse'),
(140, 'countrytext', 'userdashboard', 'Country', 'Pays'),
(141, 'statetext', 'userdashboard', 'State', 'Etat'),
(142, 'citytext', 'userdashboard', 'City', 'Ville'),
(143, 'zipcodetext', 'userdashboard', 'Zip Code', 'Code postal'),
(144, 'paySuccessHeading', 'commontext', 'Success', 'le succÃƒÂ¨s'),
(145, 'paySuccessh3', 'commontext', 'Your payment is successful.', 'Votre paiement est rÃƒÂ©ussie.'),
(146, 'paySuccesstext', 'commontext', 'Your payment is successfully done, you can access the product from your dashboard.', 'Votre paiement est effectuÃƒÂ© avec succÃƒÂ¨s , vous pouvez accÃƒÂ©der au produit de votre tableau de bord .'),
(147, 'viewmoretext', 'commontext', 'View More', 'Voir plus'),
(148, 'addtocart', 'homepage', 'Add to cart', 'Ajouter au panier'),
(149, 'gallerybtn', 'homepage', 'Preview', 'Aperçu'),
(150, 'banktransfernote', 'homepage', 'Copy these details and transfer the amount.', 'Copiez ces détails et transférer le montant .'),
(151, 'banktransfersecond', 'homepage', 'I have already made the Transactions.', 'Je l''ai déjà fait les Transactions .'),
(152, 'banktransferthird', 'homepage', 'Please, fill in the details of the transaction you have made : ', 'S''il vous plaît , remplissez les détails de la transaction que vous avez fait :'),
(154, 'payWaittext', 'commontext', 'Your transaction details have been sent to the Admin for approval. Once, details are approved you will get the product in your download section.', 'Vos détails de la transaction ont été envoyés à l'' administration pour approbation. Une fois , les détails sont approuvés , vous obtiendrez le produit dans la section de téléchargement.'),
(155, 'payWaith3', 'commontext', 'Thanks, waiting for approval.', 'Merci , en attente d''approbation .'),
(156, 'payWaitHeading', 'commontext', 'Waiting for approval', 'En attente d''approbation');

-- --------------------------------------------------------

--
-- Table structure for table `ts_levels`
--

CREATE TABLE IF NOT EXISTS `ts_levels` (
  `level_id` int(11) NOT NULL,
  `level_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ts_levels`
--

INSERT INTO `ts_levels` (`level_id`, `level_name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `ts_pages`
--

CREATE TABLE IF NOT EXISTS `ts_pages` (
  `page_id` int(11) NOT NULL,
  `page_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `page_heading` text COLLATE utf8_unicode_ci NOT NULL,
  `page_content` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ts_pages`
--

INSERT INTO `ts_pages` (`page_id`, `page_type`, `page_heading`, `page_content`) VALUES
(1, 'aboutus', 'About ThemePortal !!', '<p><img alt="About Us" src="http://images.freeimages.com/images/previews/e11/the-fisherman-1393907.jpg" style="height:440px; width:586px" /></p>\n\n<p>&nbsp;</p>\n\n<p>About ThemePortal is something which I can tell is the best marketplace framework online.</p>\n\n<p>gdfgsdfgdfgafdsgasdfgafdsg</p>\n'),
(2, 'privacypolicy', 'Privacy Policies', '<ul>\n	<li>This is first privacy policy</li>\n	<li>This is second privacy policy</li>\n	<li>This is third privacy policy</li>\n	<li>This is fourth privacy policy</li>\n	<li>This is fifth privacy policy</li>\n	<li>youy yyty</li>\n</ul>\n'),
(3, 'termsconditions', 'Terms and Conditions', '<ul>\n	<li>This is first Terms and Conditions</li>\n	<li>This is second Terms and Conditions</li>\n	<li>This is third Terms and Conditions</li>\n	<li>This is fourth Terms and Conditions</li>\n	<li>This is fifth Terms and Conditions</li>\n	<li>yyerher kjerhkwer dfsdf</li>\n</ul>\n');

-- --------------------------------------------------------

--
-- Table structure for table `ts_paymentdetails`
--

CREATE TABLE IF NOT EXISTS `ts_paymentdetails` (
  `payment_id` int(11) NOT NULL,
  `payment_uid` int(11) NOT NULL,
  `payment_pid` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `payment_uniqid` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `payment_date` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `payment_mode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `payment_amount` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `payment_email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `payment_note` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_plans`
--

CREATE TABLE IF NOT EXISTS `ts_plans` (
  `plan_id` int(11) NOT NULL,
  `plan_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `plan_amount` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `plan_product` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `plan_features` text COLLATE utf8_unicode_ci NOT NULL,
  `plan_status` int(11) NOT NULL DEFAULT '1',
  `plan_duration` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ts_plans`
--

INSERT INTO `ts_plans` (`plan_id`, `plan_name`, `plan_amount`, `plan_product`, `plan_features`, `plan_status`, `plan_duration`) VALUES
(1, 'Basic', '70', '1', '3 theme access\nfull support 24 X 7\nfree customisation\none time fees', 1, '1 Days'),
(2, 'Popular', '150', '10', '3 theme access\nfull support 24 X 7\nfree customisation\none time fees', 1, '3 Years'),
(3, 'Premium', '300', 'All', '3 theme access\nfull support 24 X 7\nfree customisation\none time fees', 1, 'Life Time ');

-- --------------------------------------------------------

--
-- Table structure for table `ts_prodgallery`
--

CREATE TABLE IF NOT EXISTS `ts_prodgallery` (
  `prodgallery_id` int(11) NOT NULL,
  `prodgallery_img` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prodgallery_pid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_products`
--

CREATE TABLE IF NOT EXISTS `ts_products` (
  `prod_id` int(11) NOT NULL,
  `prod_name` text COLLATE utf8_unicode_ci NOT NULL,
  `prod_urlname` text COLLATE utf8_unicode_ci NOT NULL,
  `prod_image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `prod_tags` text COLLATE utf8_unicode_ci NOT NULL,
  `prod_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `prod_demourl` text COLLATE utf8_unicode_ci NOT NULL,
  `prod_cateid` int(11) NOT NULL,
  `prod_filename` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `prod_price` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `prod_plan` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prod_free` tinyint(4) NOT NULL,
  `prod_featured` tinyint(4) NOT NULL,
  `prod_status` tinyint(4) DEFAULT '1',
  `prod_uniqid` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `prod_date` timestamp NULL DEFAULT NULL,
  `prod_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `prod_download_count` bigint(20) NOT NULL DEFAULT '0',
  `prod_gallery` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_product_analysis`
--

CREATE TABLE IF NOT EXISTS `ts_product_analysis` (
  `prod_analysis_id` int(11) NOT NULL,
  `prod_analysis_prodid` int(11) NOT NULL,
  `prod_analysis_date` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `prod_analysis_browser` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prod_analysis_device` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prod_analysis_ipaddr` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `prod_analysis_views` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `prod_analysis_pagetype` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_purchaserecord`
--

CREATE TABLE IF NOT EXISTS `ts_purchaserecord` (
  `purrec_id` int(11) NOT NULL,
  `purrec_prodid` int(11) NOT NULL,
  `purrec_uid` int(11) NOT NULL,
  `purrec_date` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `purrec_purcode` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_settings`
--

CREATE TABLE IF NOT EXISTS `ts_settings` (
  `uniq_id` int(11) NOT NULL,
  `key_text` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `value_text` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ts_settings`
--

INSERT INTO `ts_settings` (`uniq_id`, `key_text`, `value_text`) VALUES
(1, 'languageoption_text', 'english,french'),
(2, 'weblanguage_text', 'english'),
(3, 'languagesection_text', 'title,message,homepage,singleproductpage,commontext,menus,authentication,userdashboard'),
(4, 'metatags_text', 'themeportal , shop'),
(5, 'sitetitle_text', 'ThemePortal - Single Product Marketplace'),
(6, 'sitename_text', 'ThemePortal - Kamleshyadav''s Product'),
(7, 'seodescr_text', 'Themeportal is the single product marketplace, where user can find all products.'),
(8, 'siteauthor_text', 'Kamleshyadav'),
(9, 'logo_url', 'http://kamleshyadav.com/scripts/tp2/webimage/logo.png'),
(10, 'favicon_url', 'http://kamleshyadav.com/scripts/tp2/webimage/favicon.ico'),
(11, 'preloader_url', 'http://kamleshyadav.com/scripts/tp2/webimage/preloader.gif'),
(12, 'siteemail_text', 'info@themeportal.com'),
(13, 'sitephone_text', '+00000000'),
(14, 'siteaddress_text', 'Virtual Office'),
(15, 'siteemail_checkbox', '1'),
(16, 'sitephone_checkbox', '1'),
(17, 'siteaddress_checkbox', '1'),
(18, 'googlelink_url', 'https://google.com'),
(19, 'googlelink_checkbox', '1'),
(20, 'twitterlink_url', 'https://twitter.com'),
(21, 'twitterlink_checkbox', '1'),
(22, 'fblink_url', 'https://facebook.com'),
(23, 'fblink_checkbox', '1'),
(24, 'copyright_text', 'All rights reserved'),
(25, 'copyright_checkbox', '1'),
(26, 'portal_curreny', 'USD'),
(27, 'portalcurreny_symbol', '$'),
(28, 'portal_revenuemodel', 'singlecost'),
(50, 'shownewsletter_checkbox', '1'),
(30, 'newsletter_subs', '0'),
(31, 'registeredemails_subs', '1'),
(32, 'contactemails_subs', '0'),
(39, 'forgotpwdemail_linktext', 'Reset Password'),
(34, 'registrationemail_text', 'Hi [username],[break][break]\nPlease, click on the link below to activate your account. [break]\n[linktext] \n[break]\n[break]\nThanks,[break][break]\nTeam ThemePortal.'),
(35, 'email_logoshow', '1'),
(36, 'email_fromname', 'help'),
(37, 'email_fromemail', 'help@themeportal.com'),
(38, 'forgotpwdemail_text', 'Hi [username],[break][break]\nPlease, click on the link below to reset your password. [break]\n[linktext] \n[break]\n[break]\nThanks,[break][break]\nTeam ThemePortal.'),
(40, 'registrationemail_linktext', 'Click here'),
(41, 'paypal_status', '1'),
(42, 'paypal_email', 'reply@himanshusofttech.com'),
(43, 'payu_status', '1'),
(44, 'payu_merchantKey', '86Ds883U0'),
(45, 'payu_merchantSalt', 'f7R9DdidZU'),
(46, 'dontshow_emptycate', '1'),
(47, 'email_contactemail', 'support@himanshusofttech.com'),
(48, 'email_replyemail', 'reply@themeportal.com'),
(49, 'email_replytoshow', '1'),
(51, 'sitecolor_code', 'BAFBF0'),
(52, 'menuHome_checkbox', '1'),
(53, 'menuAboutUs_checkbox', '1'),
(54, 'menuProducts_checkbox', '1'),
(55, 'menuContactUs_checkbox', '1'),
(56, 'menuSupport_checkbox', '1'),
(57, 'menuTnC_checkbox', '1'),
(58, 'menuPrivacy_checkbox', '1'),
(59, 'sitehighcolor_code', 'D6BFDC'),
(60, 'menuPricingtbl_checkbox', '1'),
(65, 'showfeaturedsales_checkbox', '0'),
(66, 'stripe_status', '1'),
(67, 'stripe_secretKey', 'sk_test_3Y0wT5FRpR9UoOmCx9i9RrfO'),
(68, 'stripe_publishableKey', 'pk_test_7GPMYgsWynTIXpdOA84YiMXN'),
(69, '2checkout_status', '1'),
(70, '2checkout_acntnumber', '12345612'),
(71, 'banktransfer_status', '1'),
(72, 'banktransfer_details', 'Bank Name : Dummy Bank\nAccount Number : 1234567890');

-- --------------------------------------------------------

--
-- Table structure for table `ts_status`
--

CREATE TABLE IF NOT EXISTS `ts_status` (
  `status_id` int(11) NOT NULL,
  `status_text` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_status`
--

INSERT INTO `ts_status` (`status_id`, `status_text`) VALUES
(1, 'Active'),
(2, 'In Active'),
(3, 'Blocked');

-- --------------------------------------------------------

--
-- Table structure for table `ts_testimonial`
--

CREATE TABLE IF NOT EXISTS `ts_testimonial` (
  `testi_id` int(11) NOT NULL,
  `testi_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `testi_desig` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `testi_msg` text COLLATE utf8_unicode_ci NOT NULL,
  `testi_showdesig` tinyint(4) NOT NULL,
  `testi_image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `testi_status` tinyint(4) NOT NULL DEFAULT '1',
  `testi_order` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_themes`
--

CREATE TABLE IF NOT EXISTS `ts_themes` (
  `theme_id` int(11) NOT NULL,
  `theme_displayname` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `theme_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `theme_status` tinyint(4) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ts_themes`
--

INSERT INTO `ts_themes` (`theme_id`, `theme_displayname`, `theme_name`, `theme_status`) VALUES
(1, 'Default', 'default', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ts_user`
--

CREATE TABLE IF NOT EXISTS `ts_user` (
  `user_id` int(11) NOT NULL,
  `user_uname` varchar(250) NOT NULL,
  `user_fname` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_lname` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_pwd` text NOT NULL,
  `user_mobile` varchar(250) NOT NULL,
  `user_address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_country` int(11) NOT NULL,
  `user_state` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_city` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_zip` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_registerdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_status` int(11) NOT NULL,
  `user_key` varchar(250) NOT NULL,
  `user_accesslevel` int(11) NOT NULL,
  `user_plans` int(11) NOT NULL,
  `user_plansdate` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ts_categories`
--
ALTER TABLE `ts_categories`
  ADD PRIMARY KEY (`cate_id`);

--
-- Indexes for table `ts_country`
--
ALTER TABLE `ts_country`
  ADD PRIMARY KEY (`countryId`);

--
-- Indexes for table `ts_downloadtbl`
--
ALTER TABLE `ts_downloadtbl`
  ADD PRIMARY KEY (`download_id`);

--
-- Indexes for table `ts_emaillist`
--
ALTER TABLE `ts_emaillist`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `ts_emailproviders`
--
ALTER TABLE `ts_emailproviders`
  ADD PRIMARY KEY (`ep_id`);

--
-- Indexes for table `ts_eplist`
--
ALTER TABLE `ts_eplist`
  ADD PRIMARY KEY (`eplist_id`);

--
-- Indexes for table `ts_language`
--
ALTER TABLE `ts_language`
  ADD PRIMARY KEY (`language_id`);

--
-- Indexes for table `ts_levels`
--
ALTER TABLE `ts_levels`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `ts_pages`
--
ALTER TABLE `ts_pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `ts_paymentdetails`
--
ALTER TABLE `ts_paymentdetails`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `ts_plans`
--
ALTER TABLE `ts_plans`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `ts_prodgallery`
--
ALTER TABLE `ts_prodgallery`
  ADD PRIMARY KEY (`prodgallery_id`);

--
-- Indexes for table `ts_products`
--
ALTER TABLE `ts_products`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `ts_product_analysis`
--
ALTER TABLE `ts_product_analysis`
  ADD PRIMARY KEY (`prod_analysis_id`);

--
-- Indexes for table `ts_purchaserecord`
--
ALTER TABLE `ts_purchaserecord`
  ADD PRIMARY KEY (`purrec_id`);

--
-- Indexes for table `ts_settings`
--
ALTER TABLE `ts_settings`
  ADD PRIMARY KEY (`uniq_id`), ADD UNIQUE KEY `key_text` (`key_text`);

--
-- Indexes for table `ts_status`
--
ALTER TABLE `ts_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `ts_testimonial`
--
ALTER TABLE `ts_testimonial`
  ADD PRIMARY KEY (`testi_id`);

--
-- Indexes for table `ts_themes`
--
ALTER TABLE `ts_themes`
  ADD PRIMARY KEY (`theme_id`);

--
-- Indexes for table `ts_user`
--
ALTER TABLE `ts_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ts_categories`
--
ALTER TABLE `ts_categories`
  MODIFY `cate_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ts_country`
--
ALTER TABLE `ts_country`
  MODIFY `countryId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=242;
--
-- AUTO_INCREMENT for table `ts_downloadtbl`
--
ALTER TABLE `ts_downloadtbl`
  MODIFY `download_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ts_emaillist`
--
ALTER TABLE `ts_emaillist`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ts_emailproviders`
--
ALTER TABLE `ts_emailproviders`
  MODIFY `ep_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ts_eplist`
--
ALTER TABLE `ts_eplist`
  MODIFY `eplist_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ts_language`
--
ALTER TABLE `ts_language`
  MODIFY `language_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=157;
--
-- AUTO_INCREMENT for table `ts_levels`
--
ALTER TABLE `ts_levels`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ts_pages`
--
ALTER TABLE `ts_pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ts_paymentdetails`
--
ALTER TABLE `ts_paymentdetails`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ts_plans`
--
ALTER TABLE `ts_plans`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ts_prodgallery`
--
ALTER TABLE `ts_prodgallery`
  MODIFY `prodgallery_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ts_products`
--
ALTER TABLE `ts_products`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ts_product_analysis`
--
ALTER TABLE `ts_product_analysis`
  MODIFY `prod_analysis_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ts_purchaserecord`
--
ALTER TABLE `ts_purchaserecord`
  MODIFY `purrec_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ts_settings`
--
ALTER TABLE `ts_settings`
  MODIFY `uniq_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `ts_status`
--
ALTER TABLE `ts_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ts_testimonial`
--
ALTER TABLE `ts_testimonial`
  MODIFY `testi_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ts_themes`
--
ALTER TABLE `ts_themes`
  MODIFY `theme_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ts_user`
--
ALTER TABLE `ts_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
