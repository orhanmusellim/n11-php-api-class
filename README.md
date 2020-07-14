<!-- PROJECT LOGO -->
<br />
<p align="center">

  <div align="center">
  <img src="assets/om-logo.png" alt="Logo" width="180" height="180">
  </div>

  <h2 align="center">PHP - N11 API Class</h2>
     <br />
<div align="center">
  <img src="assets/n11-logo.png" alt="Logo" width="180">
  </div>
  <br />
  <p align="center">
    PHP Projelerinize dahil ederek kullanabileceğiniz N11 API Entegrasyonu için hazırlanmış basit bir Class'dır.
    <br />
    
  </p>

</p>


## Kullanım

1. N11 Classını sayfanıza çağırın ve yeni bir class türetin.
```sh
include '/n11.php';
$n11 = new N11('appKey', 'appSecret');
```

2. Class içerisindeki metodları türetmiş olduğunuz class üzerinden kullanabilirsiniz. Örnek olarak N11 sistemindeki tüm üst seviye kategorileri aşağıdaki şekilde listeleyebilirsiniz..

```sh
$n11Categories = $n11->GetTopLevelCategories();
```

