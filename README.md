# Caliper Sample App for PHP Sensor

ログインとログアウトの SessionEvent を送信するサンプルアプリケーションです。

イベントの送信処理は lib/caliper-session.php に記述されています。


## 実行方法

caliper-session.php の $endpoint や $apikey を各自の環境に合わせた値に書き換えてください。

public フォルダを外部アクセス可能として、login.php にWebブラウザ等からアクセスしてください。

画面上のLogin/Logoutボタンを押すと SessionEvent が送信されます。


## References

Caliper Analytics v1 Final Specification

- [Caliper Analytics v1 Best Practice Guide](http://www.imsglobal.org/caliper/caliperv1p0/ims-caliper-analytics-best-practice-guide)
- [Caliper Analytics v1 Implementation Guide](http://www.imsglobal.org/caliper/caliperv1p0/ims-caliper-analytics-implementation-guide)
- [Caliper Analtyics v1 Conformance Guide](http://www.imsglobal.org/caliper/caliperv1p0/ims-caliper-analytics-conformance-and-certification-guide-v10)
- [Sensor APIs](http://www.imsglobal.org/caliper-analytics-v1-public-repos-sensor-apis)
