<!DOCTYPE html>
<html>
<head>
      <title></title>
      <link rel="stylesheet" type="text/css" href="css/style.min.css">
      <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->
</head>
<body>

<div ng-app="myApp" ng-controller="myCtrl">
    
    <div id="jstwitter">
        <div ng-repeat="t in tweets">
            <div class="tweet">
                <div>{{t.user.name}}</div>
                <div ng-bind-html="render(t.text)"></div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript" src="script/angularjs/1.4.2/angular.min.js"></script>
<script type="text/javascript" src="script/twitter.js"></script>
</body>
</html>
