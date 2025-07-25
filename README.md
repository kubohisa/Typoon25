す# Typoon25

This is Cheap Weight WEB Framework "Typoon".
 
 "Typoon" are Typo + Typhoon + a bit Brainstorm.

![logo_text](https://github.com/user-attachments/assets/65b8e5e8-fcdf-4873-899c-ae70d6412ee9)

 Ver Alpha.

## アメリカンジョーク

<!--
「プログラミングはPHPとの戦いです。クイズ・Typoon25！」
-->

「象を冷蔵庫へ入れる方法を知ってます？」<br/>
「どうやるんですか？」<br/>
「冷蔵庫を開けて、象を入れて、冷蔵庫のドアを閉めるんです」<br/>
「とても、小さな象だったんですね！」

## あらすじ

このフレームワークは「マイクロ・フレームワークへHTMLテンプレートを追加すればWEBフレームワークが作れるのでは？」と言う単純な発想から始まってます

phpのウェブ・フレームワークは、JavaやRubyのフレームワークの影響を受けている物が多いのですが。Typoon25は、Go言語の影響を受けているフレームワークとなります

golangは、標準のサーバー機能へ、それぞれの機能を持ったモジュールを追加してサーバーを作るのですが。その発想も持ってきて

単純でシンプルでスマートでクールなフレームワーク。それを「チープ」と言ってますが。コンパクトなフレームワークが作れたらと思い制作してます

今回は、生成ＡＩの使い方を覚えたくて。生成ＡＩを使いながらフレームワークを作り込むのが目的です

現時点でのソースリストは仮組みの状態ですので、使える状態では無いはずです

以上、求職中で仕事が見つからなくて暇なので。暇つぶしでマイペースで制作して行きますので。よろしくお願いします

## 説明文

基本的な実装としては、ディレクトリ構成などがあるのでURLルーターやフレームワーク依存の部分はハード・コーディングで実装してます

他の機能はモジュール型のライブラリとしてバラバラな形で実装していて。既存のライブラリと置き換える事を可能としてます

phpなどでは良く知られている、Action-Domain-Responder（ADR）パターンを踏まえていて。Action＝URLルーター、Responder＝HTMLテンプレート・ライブラリと言う発想で実装してます

URLルーターは正規表現を使って実装しており、その処理速度は高速ではありません

このフレームワークは、単一のフレームワークのみで複数のウェブアプリケーションを動作出来たらと思いながら制作してますが。まだ、phpのインメモリサーバーのみでしか動作確認しておりません

安いサーバーでの使う事を前提として、簡易的なWAF（Web Application Firewall）を実装してますが。本物のWAFサーバーがあるのなら、それを使う方が良いと思います

マイクロフレームワークへHTMLテンプレート・ライブラリを追加する思想で制作してますので。HTMLテンプレート・ライブラリは別途、見つけてきて下さい

使える基本的なデータ送信手段としてのメゾットは「POST」のみです。GETでのデータ送信はセキュリティ上の理由でライブラリ内部で消去してます。その代わり、URLルーターで変数を取得出来る手段はあります

ウェブ・アプリケーションのディレクトリ構成は基本的な物はありますが。あくまでもADRパターンを前提とした基本的でしかないディレクトリ構成で。HTMLテンプレートを置くディレクトリなどは作ってませんので。アプリケーションが作りやすいディレクトリを、アプリケーション・ディレクトリ内で作るしか無いと思います

ライブラリ選択やディレクトリ構成は、アプリケーションやサーバーへ合わせられるカスタマイズ性を重視してます。コンパクトでフリー・スタイルなフレームワークとして制作しております

MITライセンスでコンパクトなフレームワークなので。古いPHPなどやVPSなどで使う事があれば、ソースリストを見て変更してください

バグ情報などはgithubでお願いします

あと、Typoon25のイメージ動物はオオミズナギドリです。理由は生まれた田舎の近所が舞鶴だったので

<a href="https://www.nagoya-u.ac.jp/researchinfo/result/2022/10/post-343.html"><img src="https://github.com/user-attachments/assets/1ff8552d-4d2e-4851-ac89-ec61c89631e6" style="width: 16%"></a>

## メモ

モジュールなフレームワークの利点として。新しい技術が出てきても、モジュールを取り換える事で対応出来ると言うメリットがあります

あとは、生成ＡＩでライブラリを作って対応する事が出来る。あるいは、生成ＡＩで他の言語のライブラリをコンバートして利用出来ると言うメリットもあると、フレームワークを作りながら思いました

Typoon25は、昔から使っている安価なレンタルサーバーでも使えるのを前提として、小規模なウェブアプリケーションを作れるフレームワークとして制作してます

モジュールなフレームワークは小規模なマイクロサービスなサーバーサイドアプリケーションを前提としていると思うのですが。既存のWEBフレームワークはモノリスな大規模ウェブアプリケーションを作る為の物なのだなと思いました

なので、モノリスなデータベースを分解して作るモジュラ・モノリスなサーバーサイドアプリケーションならTypoon25などのモジュールなフレームワークでも対応出来るのかも知れません

このフレームワークのコンセプトはGo言語のサーバー構築方法から得てます。基本のサーバーの機能へ、それぞれの機能のモジュールを追加してカスタマイズしたサーバーを作る方法ですが。phpでウェブフレームワークを完全モジュール化している [Divengine](https://divengine.org/) があり。それを見たのも作るきっかけの一つです

製作作業を行いながら昔のフレームワークを調べていたら、 [Merb](https://en.wikipedia.org/wiki/Merb) なる、Typoonと良く似ているコンセプトのフレームワークを見つけましたが、全然、知りませんでした。Go言語よりも早く出来ているので、Go言語がMerbの影響を受けているのかもしれません

### Tools,

Bing Image Creator : https://www.bing.com/images/create/

ROLAchan font : https://ozawa.design/store/rolachan/

_

[![DeepWiki](https://img.shields.io/badge/DeepWiki-kubohisa%2FTypoon25-blue.svg?logo=data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACwAAAAyCAYAAAAnWDnqAAAAAXNSR0IArs4c6QAAA05JREFUaEPtmUtyEzEQhtWTQyQLHNak2AB7ZnyXZMEjXMGeK/AIi+QuHrMnbChYY7MIh8g01fJoopFb0uhhEqqcbWTp06/uv1saEDv4O3n3dV60RfP947Mm9/SQc0ICFQgzfc4CYZoTPAswgSJCCUJUnAAoRHOAUOcATwbmVLWdGoH//PB8mnKqScAhsD0kYP3j/Yt5LPQe2KvcXmGvRHcDnpxfL2zOYJ1mFwrryWTz0advv1Ut4CJgf5uhDuDj5eUcAUoahrdY/56ebRWeraTjMt/00Sh3UDtjgHtQNHwcRGOC98BJEAEymycmYcWwOprTgcB6VZ5JK5TAJ+fXGLBm3FDAmn6oPPjR4rKCAoJCal2eAiQp2x0vxTPB3ALO2CRkwmDy5WohzBDwSEFKRwPbknEggCPB/imwrycgxX2NzoMCHhPkDwqYMr9tRcP5qNrMZHkVnOjRMWwLCcr8ohBVb1OMjxLwGCvjTikrsBOiA6fNyCrm8V1rP93iVPpwaE+gO0SsWmPiXB+jikdf6SizrT5qKasx5j8ABbHpFTx+vFXp9EnYQmLx02h1QTTrl6eDqxLnGjporxl3NL3agEvXdT0WmEost648sQOYAeJS9Q7bfUVoMGnjo4AZdUMQku50McDcMWcBPvr0SzbTAFDfvJqwLzgxwATnCgnp4wDl6Aa+Ax283gghmj+vj7feE2KBBRMW3FzOpLOADl0Isb5587h/U4gGvkt5v60Z1VLG8BhYjbzRwyQZemwAd6cCR5/XFWLYZRIMpX39AR0tjaGGiGzLVyhse5C9RKC6ai42ppWPKiBagOvaYk8lO7DajerabOZP46Lby5wKjw1HCRx7p9sVMOWGzb/vA1hwiWc6jm3MvQDTogQkiqIhJV0nBQBTU+3okKCFDy9WwferkHjtxib7t3xIUQtHxnIwtx4mpg26/HfwVNVDb4oI9RHmx5WGelRVlrtiw43zboCLaxv46AZeB3IlTkwouebTr1y2NjSpHz68WNFjHvupy3q8TFn3Hos2IAk4Ju5dCo8B3wP7VPr/FGaKiG+T+v+TQqIrOqMTL1VdWV1DdmcbO8KXBz6esmYWYKPwDL5b5FA1a0hwapHiom0r/cKaoqr+27/XcrS5UwSMbQAAAABJRU5ErkJggg==)](https://deepwiki.com/kubohisa/Typoon25)

