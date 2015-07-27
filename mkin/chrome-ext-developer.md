a folder with manifest file:

# manifest.json
    {
      "manifest_version": 2,

      "name": "Chrome Web Developer",
      "version": "1.0",
      "description": "Chrome Extension for Web Developers.",

      "icons": { "24": "images/main-icon-24.png", "128": "images/main-icon-128.png" },

      "browser_action": {
        "default_icon": "images/main-icon-24.png",
        "default_title": "Chrome Web Developer",
        "default_popup": "popup.html" 
      },

      "background": {
        "scripts": ["event-loop.js"],
        "persistent": false
      },

      "content_scripts": [
        {
          "matches": ["*://*/*"],
          "js": ["lib/jquery-1.8.3.min.js", "inject.js"]
        }
      ],

      "permissions": ["<all_urls>"]
    }

# name, version, descriptions etc. 
# to work live, goto chrom://extensions and on developer mode, then load unpacked ext.

# browser action: first interaction point for user

# background: background event loop script, running all times and creating bridge between this extension and loaded page env.

# content scripts: scripts that are injected into loaded page.
