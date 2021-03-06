<?php
/**
*   Friend of a Friend (FOAF) Vocabulary (Resource)
*
*   @version $Id: FOAF_C.php 431 2007-05-01 15:49:19Z cweiske $
*   @author Tobias Gauß (tobias.gauss@web.de)
*   @package vocabulary
*
*   Wrapper, defining resources for all terms of the
*   Friend of a Friend project (FOAF).
*   For details about FOAF see: http://xmlns.com/foaf/0.1/.
*   Using the wrapper allows you to define all aspects of
*   the vocabulary in one spot, simplifing implementation and
*   maintainence.
*/

//Made all methods static - Miel Vander Sande


class FOAF{


	static function AGENT()
	{
		return  new Resource(FOAF_NS . 'Agent');

	}

	static function DOCUMENT()
	{
		return  new Resource(FOAF_NS . 'Document');

	}

	static function GROUP()
	{
		return  new Resource(FOAF_NS . 'Group');

	}

	static function IMAGE()
	{
		return  new Resource(FOAF_NS . 'Image');

	}

	static function ONLINE_ACCOUNT()
	{
		return  new Resource(FOAF_NS . 'OnlineAccount');

	}

	static function ONLINE_CHAT_ACCOUNT()
	{
		return  new Resource(FOAF_NS . 'OnlineChatAccount');

	}

	static function ONLINE_ECOMMERCE_ACCOUNT()
	{
		return  new Resource(FOAF_NS . 'OnlineEcommerceAccount');

	}

	static function ONLINE_GAMING_ACCOUNT()
	{
		return  new Resource(FOAF_NS . 'OnlineGamingAccount');

	}

	static function ORGANIZATION()
	{
		return  new Resource(FOAF_NS . 'Organization');

	}

	static function PERSON()
	{
		return  new Resource(FOAF_NS . 'Person');

	}

	static function PERSONAL_PROFILE_DOCUMENT()
	{
		return  new Resource(FOAF_NS . 'PersonalProfileDocument');

	}

	static function PROJECT()
	{
		return  new Resource(FOAF_NS . 'Project');

	}

	static function ACCOUNT_NAME()
	{
		return  new Resource(FOAF_NS . 'accountName');

	}

	static function ACCOUNT_SERVICE_HOMEPAGE()
	{
		return  new Resource(FOAF_NS . 'accountServiceHomepage');

	}

	static function AIM_CHAT_ID()
	{
		return  new Resource(FOAF_NS . 'aimChatID');

	}

	static function BASED_NEAR()
	{
		return  new Resource(FOAF_NS . 'based_near');

	}

	static function CURRENT_PROJECT()
	{
		return  new Resource(FOAF_NS . 'currentProject');

	}

	static function DEPICTION()
	{
		return  new Resource(FOAF_NS . 'depiction');

	}

	static function DEPICTS()
	{
		return  new Resource(FOAF_NS . 'depicts');

	}

	static function DNA_CHECKSUM()
	{
		return  new Resource(FOAF_NS . 'dnaChecksum');

	}

	static function FAMILY_NAME()
	{
		return  new Resource(FOAF_NS . 'family_name');

	}

	static function FIRST_NAME()
	{
		return  new Resource(FOAF_NS . 'firstName');

	}

	static function FUNDED_BY()
	{
		return  new Resource(FOAF_NS . 'fundedBy');

	}

	static function GEEKCODE()
	{
		return  new Resource(FOAF_NS . 'geekcode');

	}

	static function GENDER()
	{
		return  new Resource(FOAF_NS . 'gender');

	}

	static function GIVENNAME()
	{
		return  new Resource(FOAF_NS . 'givenname');

	}

	static function HOLDS_ACCOUNT()
	{
		return  new Resource(FOAF_NS . 'holdsAccount');

	}

	static function HOMEPAGE()
	{
		return  new Resource(FOAF_NS . 'homepage');

	}

	static function ICQ_CHAT_ID()
	{
		return  new Resource(FOAF_NS . 'icqChatID');

	}

	static function IMG()
	{
		return  new Resource(FOAF_NS . 'img');

	}

	static function INTEREST()
	{
		return  new Resource(FOAF_NS . 'interest');

	}

	static function JABBER_ID()
	{
		return  new Resource(FOAF_NS . 'jabberID');

	}

	static function KNOWS()
	{
		return  new Resource(FOAF_NS . 'knows');

	}

	static function LOGO()
	{
		return  new Resource(FOAF_NS . 'logo');

	}

	static function MADE()
	{
		return  new Resource(FOAF_NS . 'made');

	}

	static function MAKER()
	{
		return  new Resource(FOAF_NS . 'maker');

	}

	static function MBOX()
	{
		return  new Resource(FOAF_NS . 'mbox');

	}

	static function MBOX_SHA1SUM()
	{
		return  new Resource(FOAF_NS . 'mbox_sha1sum');

	}

	static function MEMBER()
	{
		return  new Resource(FOAF_NS . 'member');

	}

	static function MEMBERSHIP_CLASS()
	{
		return new Resource(FOAF_NS . 'membershipClass');

	}

	static function MSN_CHAT_ID()
	{
		return  new Resource(FOAF_NS . 'msnChatID');

	}

	static function MYERS_BRIGGS()
	{
		return  new Resource(FOAF_NS . 'myersBriggs');

	}

	static function NAME()
	{
		return  new Resource(FOAF_NS . 'name');

	}

	static function NICK()
	{
		return  new Resource(FOAF_NS . 'nick');

	}

	static function PAGE()
	{
		return  new Resource(FOAF_NS . 'page');

	}

	static function PAST_PROJECT()
	{
		return  new Resource(FOAF_NS . 'pastProject');

	}

	static function PHONE()
	{
		return  new Resource(FOAF_NS . 'phone');

	}

	static function PLAN()
	{
		return  new Resource(FOAF_NS . 'plan');

	}

	static function PRIMARY_TOPIC()
	{
		return  new Resource(FOAF_NS . 'primaryTopic');

	}

	static function PUBLICATIONS()
	{
		return  new Resource(FOAF_NS . 'publications');

	}

	static function SCHOOL_HOMEPAGE()
	{
		return  new Resource (FOAF_NS . 'schoolHomepage');

	}

	static function SHA1()
	{
		return  new Resource (FOAF_NS . 'sha1');

	}

	static function SURNAME()
	{
		return  new Resource (FOAF_NS . 'surname');

	}

	static function THEME()
	{
		return  new Resource(FOAF_NS . 'theme');

	}

	static function THUMBNAIL()
	{
		return  new Resource(FOAF_NS . 'thumbnail');

	}

	static function TIPJAR()
	{
		return  new Resource(FOAF_NS . 'tipjar');

	}

	static function TITLE()
	{
		return  new Resource(FOAF_NS . 'title');

	}

	static function TOPIC()
	{
		return  new Resource(FOAF_NS . 'topic');

	}

	static function TOPIC_INTEREST()
	{
		return  new Resource(FOAF_NS . 'topic_interest');

	}

	static function WEBLOG()
	{
		return  new Resource(FOAF_NS . 'weblog');

	}

	static function WORK_INFO_HOMEPAGE()
	{
		return  new Resource(FOAF_NS . 'workInfoHomepage');

	}

	static function WORKPLACE_HOMEPAGE()
	{
		return  new Resource(FOAF_NS . 'workplaceHomepage');

	}

	static function YAHOO_CHAT_ID()
	{
		return  new Resource(FOAF_NS . 'yahooChatID');
	}
}





?>