(function (angular) {
    "use strict";
    var app = angular.module("myApp", []);

    app.factory("Twitter", function () {
        return {

            link: function (tweet) {
                return tweet.replace(/\b(((https*\:\/\/)|www\.)[^\"\']+?)(([!?,.\)]+)?(\s|$))/g, function(link, m1, m2, m3, m4) {
                      var http = m2.match(/w/) ? 'http://' : '';
                    return '<a class="twtr-hyperlink" target="_blank" href="' + http + m1 + '">' + ((m1.length > 25) ? m1.substr(0, 24) + "..." : m1) + "</a>" + m4;
                  });
            },

            at: function (tweet) {
                return tweet.replace(/\B[@＠]([a-zA-Z0-9_]{1,20})/g, function (m, username) {
                    return '<a target="_blank" class="twtr-atreply" href="http://twitter.com/intent/user?screen_name=' + username + '">@' + username + "</a>";
                });
            },

            list: function (tweet) {
                return tweet.replace(/\B[@＠]([a-zA-Z0-9_]{1,20}\/\w+)/g, function (m, userlist) {
                    return '<a target="_blank" class="twtr-atreply" href="http://twitter.com/' + userlist + '">@' + userlist + "</a>";
                });
            },

            hash: function (tweet) {
                return tweet.replace(/(^|\s+)#(\w+)/gi, function (m, before, hash) {
                    return before + '<a target="_blank" class="twtr-hashtag" href="http://twitter.com/search?q=%23' + hash + '">#' + hash + "</a>";
                });
            },

            clean: function (tweet) {
                return this.hash(this.at(this.list(this.link(tweet))));
            }
        };
    });

    app.controller("myCtrl", function ($scope, $http, $interval, $timeout, $sce, Twitter) {
        $scope.events = [];
        $scope.render = function (e) {
            return $sce.trustAsHtml(Twitter.clean(e));
        }
        $scope.ajax_call = function () {
            $http.get("twitter.php")
                .then(function (response) {
                $scope.tweets = response.data;
              })
        }
        /* fetch tweets from server in .5 secs then every two minutes time interval*/
        var timeput = $timeout($scope.ajax_call, 500);
        var interval = $interval($scope.ajax_call, 120000);

     /* Cancel interval when controller is out of scope */
     //$scope.$on('$destroy', function () { $interval.cancel(timer); });
    })
}(angular));