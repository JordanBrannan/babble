angular.module('app.routes', [])

.config(function($stateProvider, $urlRouterProvider) {

  // Ionic uses AngularUI Router which uses the concept of states
  // Learn more here: https://github.com/angular-ui/ui-router
  // Set up the various states which the app can be in.
  // Each state's controller can be found in controllers.js
  $stateProvider
    

      .state('menu', {
    url: '/side-menu21',
    templateUrl: 'templates/menu.html',
    controller: 'menuCtrl'
  })

  .state('menu.institution', {
    url: '/page3',
	params: {
		ParamValue: "",
		ParamValue2: ""		
},
    views: {
      'side-menu21': {
        templateUrl: 'templates/institution.html',
        controller: 'institutionCtrl'
      }
    }
  })

  .state('menu.babble', {
    url: '/page1',
    views: {
      'side-menu21': {
        templateUrl: 'templates/babble.html',
        controller: 'babbleCtrl'
      }
    }
  })

  .state('menu.newConversation', {
    url: '/page5',
    views: {
      'side-menu21': {
        templateUrl: 'templates/newConversation.html',
        controller: 'newConversationCtrl'
      }
    }
  })

  .state('menu.terms', {
    url: '/page4',
    views: {
      'side-menu21': {
        templateUrl: 'templates/terms.html',
        controller: 'termsCtrl'
      }
    }
  })

  .state('menu.privacy', {
    url: '/page5',
    views: {
      'side-menu21': {
        templateUrl: 'templates/privacy.html',
        controller: 'privacyCtrl'
      }
    }
  })

  .state('menu.conversations', {
    url: '/page15',
	params: {
		ParamValue: "",
		ParamValue2: ""		
},
    views: {
      'side-menu21': {
        templateUrl: 'templates/conversations.html',
        controller: 'conversationsCtrl'
      }
    }
  })

$urlRouterProvider.otherwise('/side-menu21/page1')


});