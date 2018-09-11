angular.module('app.controllers', [])
  
.controller('menuCtrl', ['$scope', '$stateParams', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
// You can include any angular dependencies as parameters for this function
// TIP: Access Route Parameters for your page via $stateParams.parameterName
function ($scope, $stateParams) {


}])
   
.controller('institutionCtrl', ['$scope', '$stateParams', 'Message', '$ionicPopup', '$state', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
// You can include any angular dependencies as parameters for this function
// TIP: Access Route Parameters for your page via $stateParams.parameterName
function ($scope, $stateParams, Message, $ionicPopup, $state) {
    
    // State Param Variables
    $scope.id = $stateParams.ParamValue;
    $scope.inst = $stateParams.ParamValue2;
    
    // Locally Stored ID
    $scope.myid = localStorage.getItem("id");
    
    // Messages Array
    $scope.messages = [];
    
    // Scope Data 1 For loadData Function
    $scope.data = {
        action: 'getAll',
        group: $scope.id,
        id: $scope.myid

    }
    
    // Scope Data 2 For Submit Function
    $scope.data2 = {
        action: 'newMess',
        message: '',
        group: $scope.id

    }
    
    // Scope Data 3 For Archive Function
    $scope.data3 = {
        action: 'archive',
        group: $scope.id

    }
    
    // Scope Data 4 For onLoad Function
     $scope.data4 = {
        action: 'read',
        group: $scope.id

    }
    
    // If Archive Button Pressed, PopUp Alert, If Yes, API Call To Archive Conversation
    $scope.archive = function(){
        $ionicPopup.show({
        templateUrl:  'close-alert-template.html',
        title: 'Are you sure?',
        scope: $scope,
        buttons: [
          { text: 'Cancel', onTap: function(e) { return true; } },
          {
            text: 'Delete',
            type: 'button-assertive',
            onTap: function(e) {
                
                Message.all($scope.data3).then(function(res){
                $scope.data3 = {
                action: 'archive',
                group: $scope.id
                
            }})
                
            $state.go('menu.conversations');
            }
          },
        ]
      })
    }
    
    // Reload Every Second, API Call For Messages With Pages MessageGroup
    setInterval($scope.loadData = function(){
        Message.all($scope.data).then(function(res){
            $scope.data = {
                action: 'getAll',
                group: $scope.id,
                id: $scope.myid
                
            }
            $scope.messages = res;
 
                
        setTimeout(loadData, 1000);    
            
        })
        
    },1000);
 
 
    // When Page Loads, API Call To Mark Conversation As Read
    $scope.onLoad = function(){
        Message.all($scope.data4).then(function(res){
            $scope.data4 = {
                action: 'read',
                group: $scope.id
            }
        })
    }
    
    // When Message Sent, API Call To Store New Message In DB
    $scope.submit = function(){
        Message.all($scope.data2).then(function(res){
            $scope.data2 = {
                action: 'newMess',
                message: $scope.data2.message,
                group: $scope.id
                
            }
            $resp = res;
            $scope.data2.message = '';
            $scope.data2.id = '';
            
            
        })
    }


    // Call Functions On Load
    $scope.onLoad();
    $scope.loadData();

    
}])
   
.controller('babbleCtrl', ['$scope', '$stateParams', 'Message', '$ionicPopup', '$state', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
// You can include any angular dependencies as parameters for this function
// TIP: Access Route Parameters for your page via $stateParams.parameterName
function ($scope, $stateParams, Message, $ionicPopup, $state) {
    //$scope.temp;
    //$scope.temp = localStorage.getItem("id");
    // Scope Data For New User Accounts
    $scope.data = {
        action: 'addNew',
        id: 'new'
    }
    
    // Checks If Already Locally Stored ID, If Yes, Go To Conversations Page
    $scope.onLoad = function(){
         //var temp = $scope.myid;
        if(localStorage.getItem("id") !== null){// != null || localStorage.getItem("id") !== ""){//$scope.myid != null || $scope.myid !== ""){
            $state.go('menu.conversations');
        }
        
    }
    
    // API Call To Add New User And Store ID Locally
    $scope.submit = function(){
        var temp = $scope.myid;
        Message.add($scope.data).then(function(res){
            $scope.data = {
                action: 'addNew',
                id: 'new'
            }
            $resp = res;
            localStorage.setItem('id', $resp);
        })
        
    }
    
    // Function Called On Load
    $scope.onLoad();
    
}])
   
.controller('newConversationCtrl', ['$scope', '$stateParams', 'Message', '$ionicPopup', '$state', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
// You can include any angular dependencies as parameters for this function
// TIP: Access Route Parameters for your page via $stateParams.parameterName
function ($scope, $stateParams, Message, $ionicPopup, $state) {

// Variable For NewConvo Response
$scope.resp = '';

// Get Locally Stored Variable ID
$scope.myid = localStorage.getItem("id");

// Scope Data For Submit Function
$scope.data = {
        action: 'newConv',
        id: $scope.myid,
        code: ''

    }

    
    // API Call To Create New Message Group, if Institute Exists, Go To Conversations,
    // Otherwise, Error Alert
    $scope.submit = function(){
        $resp = '';
        Message.all($scope.data).then(function(res){
            $scope.data = {
                action: 'newConv',
                id: $scope.myid,
                code: $scope.data.code
                
            }
            $resp = res;

        if($resp)
        {
           $ionicPopup.alert({
                title: 'Code Invalid',
                template: ''
            });
        }
        else{
            $state.go('menu.conversations');
        }
       
        $scope.data.code = '';
            
        })
    }
    
}])
   
.controller('termsCtrl', ['$scope', '$stateParams', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
// You can include any angular dependencies as parameters for this function
// TIP: Access Route Parameters for your page via $stateParams.parameterName
function ($scope, $stateParams) {


}])
   
.controller('privacyCtrl', ['$scope', '$stateParams', '$state', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
// You can include any angular dependencies as parameters for this function
// TIP: Access Route Parameters for your page via $stateParams.parameterName
function ($scope, $stateParams, $state) {

$scope.babble = function(){
        $state.go('menu.babble');
    }

}])
   
.controller('conversationsCtrl', ['$scope', '$stateParams', 'Message', '$state', // The following is the constructor function for this page's controller. See https://docs.angularjs.org/guide/controller
// You can include any angular dependencies as parameters for this function
// TIP: Access Route Parameters for your page via $stateParams.parameterName
function ($scope, $stateParams, Message, $state) {
    
    // Locally Stored ID
    $scope.myid = localStorage.getItem("id");
    
    // Messages Array
    $scope.messages = [];

    // Scope Data For loadData Function
    $scope.data = {
        action: 'getMess',
        id: $scope.myid

    }
    
    // API Call To Get Messages
    $scope.loadData = function(){
        Message.all($scope.data).then(function(res){
            $scope.data = {
                action: 'getMess',
                id: $scope.myid
                
            }
        
        $scope.messages = res;
        })
        
    }
    
    // Function To Load Data Every Second
    setInterval($scope.test = function(){
        $scope.loadData();
    },3000);
    
    // Load Data Function On Load
    $scope.loadData();
    
    // New Conversation Button Goes To New Conversation Page
    $scope.new = function(){
        $state.go('menu.newConversation');
    }
    
    // Click Conversation, Passes Params To Institution Page
    $scope.convo = function(str, str2){
        $state.go('menu.institution', {ParamValue: str, ParamValue2: str2});
    }

}])
 