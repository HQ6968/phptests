#phptest
php test like go test style 
# phptest run -b dir


# install 
- 请在非项目目录下执行该操作
- sudo install.sh

# examples 

examples 为对应框架需要引入的文件 , 该文件只在测试下执行 ， 不会实际加载到项目中。

# use
文件名以: .test.php 结尾
```$php
use phptests\Testing;

function testFormParams_instance(Testing $t){
    $t->log(form("input" , []));
    $t->fatal("adsfasdf");

}

```
