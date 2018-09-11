angular.module('app.services', [])


// API Call Framework
.service('Message', ['$http', function($http){

    var api_url = 'http://doc.gold.ac.uk/~jbran051/project/api/api.php';

    var ret = {
        all: function(data){
            
            return $http.post(api_url, data).then(function(resp){
                
                return resp.data;
            });
        }, 
        add: function(data){
            
            return $http.post(api_url, data).then(function(resp){
                return resp.data;
            });
            
        }
        
    }
    
    
    return ret;

}]);