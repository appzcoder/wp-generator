# WP Generator
WP Generator

Inspired by [https://github.com/tareq1988/wp-generators](https://github.com/tareq1988/wp-generators)

## Supported
- WP List Table Generator

## Installation

```bash
cd your-directory
git clone https://github.com/appzcoder/wp-generator.git
cd wp-generator
```

## Commands
For generating crud plugin:
```bash
php generator --crud-name=customer --textdomain=appzcoder --plugin-name="customer crud" --prefix=ac_ --fields="name:text:req, email:email:req, address:textarea, city:text"
```

Note: You can easily generate crud plugin. Generated stuffs will be found in your "wp-generator" directory as "your-plugin-name".zip file.

##Author

[Sohel Amin](http://www.sohelamin.com)
