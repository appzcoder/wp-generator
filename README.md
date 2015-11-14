# WP Generator
WP Generator

Inspired by [https://github.com/tareq1988/wp-generators](https://github.com/tareq1988/wp-generators)

## Installation

```bash
cd your-directory
git clone https://github.com/appzcoder/wp-generator.git
cd wp-generator
```

## Commands
For generating crud plugin:
```bash
php generator --type=plugin --crud-name=customer --textdomain=appzcoder --plugin-name="customer crud" --prefix=ac_ --fields="name:text:req, email:email:req, address:textarea, city:text"
```

For generating crud module:
```bash
php generator --type=module --crud-name=customer --textdomain=appzcoder --prefix=ac_ --fields="name:text:req, email:email:req, address:textarea, city:text"
```

Note: You can easily generate crud plugin or instead you can also generate crud module to re-use in existing or another plugin. Generated things will be found in your "wp-generator" directory as "your-crud-name".zip file.

##Author

[Sohel Amin](http://www.sohelamin.com)
