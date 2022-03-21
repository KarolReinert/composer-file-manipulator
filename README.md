# Composer File Manipulator

![alt text](background.png)


It is a simple tool that allows you to manipulate project 
files (create, copy, move and delete)` via Composer in your project directory.

Scripts are called via events definied in composer.json file.

Read More: https://getcomposer.org/doc/articles/scripts.md

## Installation

```bash
composer require reinert/composer-file-manipulator
```


## Usage
You need to edit your composer.json file.

### Initial step

```json
"scripts": {    
    "post-install-cmd": [    
      "Reinert\\ComposerFileManipulator\\ComposerFileManipulator::copy",
      "Reinert\\ComposerFileManipulator\\ComposerFileManipulator::move", 
      "Reinert\\ComposerFileManipulator\\ComposerFileManipulator::delete", 
    ],    
  },  
```

### Copy Files

```json
"extra" {    
    "copy-files" : {    
      "from" : "to"
    }    
}    
```
### Move Files

```json
"extra" {    
    "move-files" : {    
      "from" : "to"
    }    
}    
```
### Delete Files

```json
"extra" {    
    "delete-files" : {    
      "file_path"
    }    
}    
```


## Example Configuration 

```json
"scripts": {    
    "post-install-cmd": [    
      "Reinert\\ComposerFileManipulator\\ComposerFileManipulator::copy",
      "Reinert\\ComposerFileManipulator\\ComposerFileManipulator::move",
      "Reinert\\ComposerFileManipulator\\ComposerFileManipulator::delete"
    ],    
  }, 
  "extra": {    
    "copy-files": {
      "/foo/config.json" => "/bar/config.json"
    },
    "move-files": {
      "/foo/config.json" => "/bar/config.json"
    }
  }
```