# TYPO3 Extension: Eid2

EXT:eid2 provides a new entry of `eID` script in TYPO3.

The extension version only matches the TYPO3 version, it doesn't mean anything else.

## Why eID2

I like `eID` scripts, they are short and clean, and the URLs are nice. However, sometimes, I need complex codes which require `$GLOBALS['TSFE']` initialized and `TypoScript` loaded, especially the extbase repositories, like responding a 3rd-party webhook.

## How to use it

Register your `eID` script as usual in `ext_localconf.php`.

    $GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['EID_KEY'] = \Vendor\Extension\Controller\EidController::class.'::processRequest';

Now, you have two entries.

    index.php?eID=EID_KEY (The original entry)
    index.php?eID2=EID_KEY (The new entry)