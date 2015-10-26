
(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '        <ul>                <li data-name="namespace:" class="opened">                    <div style="padding-left:0px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href=".html">app</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href=".html">Http</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:app_Http_Controllers" >                    <div style="padding-left:36px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="app/Http/Controllers.html">Controllers</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:app_Http_Controllers_Auth" >                    <div style="padding-left:54px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="app/Http/Controllers/Auth.html">Auth</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:app_Http_Controllers_Auth_AuthController" >                    <div style="padding-left:80px" class="hd leaf">                        <a href="app/Http/Controllers/Auth/AuthController.html">AuthController</a>                    </div>                </li>                            <li data-name="class:app_Http_Controllers_Auth_PasswordController" >                    <div style="padding-left:80px" class="hd leaf">                        <a href="app/Http/Controllers/Auth/PasswordController.html">PasswordController</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="class:app_Http_Controllers_AdminTestController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="app/Http/Controllers/AdminTestController.html">AdminTestController</a>                    </div>                </li>                            <li data-name="class:app_Http_Controllers_AdminToolsController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="app/Http/Controllers/AdminToolsController.html">AdminToolsController</a>                    </div>                </li>                            <li data-name="class:app_Http_Controllers_Controller" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="app/Http/Controllers/Controller.html">Controller</a>                    </div>                </li>                            <li data-name="class:app_Http_Controllers_DistrictsController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="app/Http/Controllers/DistrictsController.html">DistrictsController</a>                    </div>                </li>                            <li data-name="class:app_Http_Controllers_GroupsController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="app/Http/Controllers/GroupsController.html">GroupsController</a>                    </div>                </li>                            <li data-name="class:app_Http_Controllers_MasterController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="app/Http/Controllers/MasterController.html">MasterController</a>                    </div>                </li>                            <li data-name="class:app_Http_Controllers_OrganizationsController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="app/Http/Controllers/OrganizationsController.html">OrganizationsController</a>                    </div>                </li>                            <li data-name="class:app_Http_Controllers_ProfileController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="app/Http/Controllers/ProfileController.html">ProfileController</a>                    </div>                </li>                            <li data-name="class:app_Http_Controllers_RolesController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="app/Http/Controllers/RolesController.html">RolesController</a>                    </div>                </li>                            <li data-name="class:app_Http_Controllers_UsersController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="app/Http/Controllers/UsersController.html">UsersController</a>                    </div>                </li>                </ul></div>                </li>                </ul></div>                </li>                </ul></div>                </li>                </ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                    
            {"type": "Namespace", "link": "app.html", "name": "app", "doc": "Namespace app"},{"type": "Namespace", "link": "app/Http.html", "name": "app\\Http", "doc": "Namespace app\\Http"},{"type": "Namespace", "link": "app/Http/Controllers.html", "name": "app\\Http\\Controllers", "doc": "Namespace app\\Http\\Controllers"},{"type": "Namespace", "link": "app/Http/Controllers/Auth.html", "name": "app\\Http\\Controllers\\Auth", "doc": "Namespace app\\Http\\Controllers\\Auth"},
            
            {"type": "Class", "fromName": "app\\Http\\Controllers", "fromLink": "app/Http/Controllers.html", "link": "app/Http/Controllers/AdminTestController.html", "name": "app\\Http\\Controllers\\AdminTestController", "doc": "&quot;\n&quot;"},
                                                        {"type": "Method", "fromName": "app\\Http\\Controllers\\AdminTestController", "fromLink": "app/Http/Controllers/AdminTestController.html", "link": "app/Http/Controllers/AdminTestController.html#method_index", "name": "app\\Http\\Controllers\\AdminTestController::index", "doc": "&quot;Display a listing of the resource.&quot;"},
                    {"type": "Method", "fromName": "app\\Http\\Controllers\\AdminTestController", "fromLink": "app/Http/Controllers/AdminTestController.html", "link": "app/Http/Controllers/AdminTestController.html#method_uploadImage", "name": "app\\Http\\Controllers\\AdminTestController::uploadImage", "doc": "&quot;\n&quot;"},
            
            {"type": "Class", "fromName": "app\\Http\\Controllers", "fromLink": "app/Http/Controllers.html", "link": "app/Http/Controllers/AdminToolsController.html", "name": "app\\Http\\Controllers\\AdminToolsController", "doc": "&quot;\n&quot;"},
                                                        {"type": "Method", "fromName": "app\\Http\\Controllers\\AdminToolsController", "fromLink": "app/Http/Controllers/AdminToolsController.html", "link": "app/Http/Controllers/AdminToolsController.html#method_uploadCsv", "name": "app\\Http\\Controllers\\AdminToolsController::uploadCsv", "doc": "&quot;\n&quot;"},
            
            {"type": "Class", "fromName": "app\\Http\\Controllers\\Auth", "fromLink": "app/Http/Controllers/Auth.html", "link": "app/Http/Controllers/Auth/AuthController.html", "name": "app\\Http\\Controllers\\Auth\\AuthController", "doc": "&quot;\n&quot;"},
                                                        {"type": "Method", "fromName": "app\\Http\\Controllers\\Auth\\AuthController", "fromLink": "app/Http/Controllers/Auth/AuthController.html", "link": "app/Http/Controllers/Auth/AuthController.html#method___construct", "name": "app\\Http\\Controllers\\Auth\\AuthController::__construct", "doc": "&quot;Create a new authentication controller instance.&quot;"},
            
            {"type": "Class", "fromName": "app\\Http\\Controllers\\Auth", "fromLink": "app/Http/Controllers/Auth.html", "link": "app/Http/Controllers/Auth/PasswordController.html", "name": "app\\Http\\Controllers\\Auth\\PasswordController", "doc": "&quot;\n&quot;"},
                                                        {"type": "Method", "fromName": "app\\Http\\Controllers\\Auth\\PasswordController", "fromLink": "app/Http/Controllers/Auth/PasswordController.html", "link": "app/Http/Controllers/Auth/PasswordController.html#method___construct", "name": "app\\Http\\Controllers\\Auth\\PasswordController::__construct", "doc": "&quot;Create a new password controller instance.&quot;"},
            
            {"type": "Class", "fromName": "app\\Http\\Controllers", "fromLink": "app/Http/Controllers.html", "link": "app/Http/Controllers/Controller.html", "name": "app\\Http\\Controllers\\Controller", "doc": "&quot;\n&quot;"},
                    
            {"type": "Class", "fromName": "app\\Http\\Controllers", "fromLink": "app/Http/Controllers.html", "link": "app/Http/Controllers/DistrictsController.html", "name": "app\\Http\\Controllers\\DistrictsController", "doc": "&quot;\n&quot;"},
                                                        {"type": "Method", "fromName": "app\\Http\\Controllers\\DistrictsController", "fromLink": "app/Http/Controllers/DistrictsController.html", "link": "app/Http/Controllers/DistrictsController.html#method_index", "name": "app\\Http\\Controllers\\DistrictsController::index", "doc": "&quot;Display a listing of the resource.&quot;"},
                    {"type": "Method", "fromName": "app\\Http\\Controllers\\DistrictsController", "fromLink": "app/Http/Controllers/DistrictsController.html", "link": "app/Http/Controllers/DistrictsController.html#method_district", "name": "app\\Http\\Controllers\\DistrictsController::district", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "app\\Http\\Controllers\\DistrictsController", "fromLink": "app/Http/Controllers/DistrictsController.html", "link": "app/Http/Controllers/DistrictsController.html#method_create", "name": "app\\Http\\Controllers\\DistrictsController::create", "doc": "&quot;Show the form for creating a new resource.&quot;"},
                    {"type": "Method", "fromName": "app\\Http\\Controllers\\DistrictsController", "fromLink": "app/Http/Controllers/DistrictsController.html", "link": "app/Http/Controllers/DistrictsController.html#method_store", "name": "app\\Http\\Controllers\\DistrictsController::store", "doc": "&quot;Store a newly created resource in storage.&quot;"},
                    {"type": "Method", "fromName": "app\\Http\\Controllers\\DistrictsController", "fromLink": "app/Http/Controllers/DistrictsController.html", "link": "app/Http/Controllers/DistrictsController.html#method_show", "name": "app\\Http\\Controllers\\DistrictsController::show", "doc": "&quot;Display the specified resource.&quot;"},
                    {"type": "Method", "fromName": "app\\Http\\Controllers\\DistrictsController", "fromLink": "app/Http/Controllers/DistrictsController.html", "link": "app/Http/Controllers/DistrictsController.html#method_edit", "name": "app\\Http\\Controllers\\DistrictsController::edit", "doc": "&quot;Show the form for editing the specified resource.&quot;"},
                    {"type": "Method", "fromName": "app\\Http\\Controllers\\DistrictsController", "fromLink": "app/Http/Controllers/DistrictsController.html", "link": "app/Http/Controllers/DistrictsController.html#method_update", "name": "app\\Http\\Controllers\\DistrictsController::update", "doc": "&quot;Update the specified resource in storage.&quot;"},
                    {"type": "Method", "fromName": "app\\Http\\Controllers\\DistrictsController", "fromLink": "app/Http/Controllers/DistrictsController.html", "link": "app/Http/Controllers/DistrictsController.html#method_destroy", "name": "app\\Http\\Controllers\\DistrictsController::destroy", "doc": "&quot;Remove the specified resource from storage.&quot;"},
            
            {"type": "Class", "fromName": "app\\Http\\Controllers", "fromLink": "app/Http/Controllers.html", "link": "app/Http/Controllers/GroupsController.html", "name": "app\\Http\\Controllers\\GroupsController", "doc": "&quot;\n&quot;"},
                                                        {"type": "Method", "fromName": "app\\Http\\Controllers\\GroupsController", "fromLink": "app/Http/Controllers/GroupsController.html", "link": "app/Http/Controllers/GroupsController.html#method_index", "name": "app\\Http\\Controllers\\GroupsController::index", "doc": "&quot;Display a listing of the resource.&quot;"},
                    {"type": "Method", "fromName": "app\\Http\\Controllers\\GroupsController", "fromLink": "app/Http/Controllers/GroupsController.html", "link": "app/Http/Controllers/GroupsController.html#method_group", "name": "app\\Http\\Controllers\\GroupsController::group", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "app\\Http\\Controllers\\GroupsController", "fromLink": "app/Http/Controllers/GroupsController.html", "link": "app/Http/Controllers/GroupsController.html#method_create", "name": "app\\Http\\Controllers\\GroupsController::create", "doc": "&quot;Show the form for creating a new resource.&quot;"},
                    {"type": "Method", "fromName": "app\\Http\\Controllers\\GroupsController", "fromLink": "app/Http/Controllers/GroupsController.html", "link": "app/Http/Controllers/GroupsController.html#method_store", "name": "app\\Http\\Controllers\\GroupsController::store", "doc": "&quot;Store a newly created resource in storage.&quot;"},
                    {"type": "Method", "fromName": "app\\Http\\Controllers\\GroupsController", "fromLink": "app/Http/Controllers/GroupsController.html", "link": "app/Http/Controllers/GroupsController.html#method_show", "name": "app\\Http\\Controllers\\GroupsController::show", "doc": "&quot;Display the specified resource.&quot;"},
                    {"type": "Method", "fromName": "app\\Http\\Controllers\\GroupsController", "fromLink": "app/Http/Controllers/GroupsController.html", "link": "app/Http/Controllers/GroupsController.html#method_edit", "name": "app\\Http\\Controllers\\GroupsController::edit", "doc": "&quot;Show the form for editing the specified resource.&quot;"},
                    {"type": "Method", "fromName": "app\\Http\\Controllers\\GroupsController", "fromLink": "app/Http/Controllers/GroupsController.html", "link": "app/Http/Controllers/GroupsController.html#method_update", "name": "app\\Http\\Controllers\\GroupsController::update", "doc": "&quot;Update the specified resource in storage.&quot;"},
                    {"type": "Method", "fromName": "app\\Http\\Controllers\\GroupsController", "fromLink": "app/Http/Controllers/GroupsController.html", "link": "app/Http/Controllers/GroupsController.html#method_destroy", "name": "app\\Http\\Controllers\\GroupsController::destroy", "doc": "&quot;Remove the specified resource from storage.&quot;"},
            
            {"type": "Class", "fromName": "app\\Http\\Controllers", "fromLink": "app/Http/Controllers.html", "link": "app/Http/Controllers/MasterController.html", "name": "app\\Http\\Controllers\\MasterController", "doc": "&quot;\n&quot;"},
                                                        {"type": "Method", "fromName": "app\\Http\\Controllers\\MasterController", "fromLink": "app/Http/Controllers/MasterController.html", "link": "app/Http/Controllers/MasterController.html#method___construct", "name": "app\\Http\\Controllers\\MasterController::__construct", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "app\\Http\\Controllers\\MasterController", "fromLink": "app/Http/Controllers/MasterController.html", "link": "app/Http/Controllers/MasterController.html#method_search", "name": "app\\Http\\Controllers\\MasterController::search", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "app\\Http\\Controllers\\MasterController", "fromLink": "app/Http/Controllers/MasterController.html", "link": "app/Http/Controllers/MasterController.html#method_friendship", "name": "app\\Http\\Controllers\\MasterController::friendship", "doc": "&quot;\n&quot;"},
            
            {"type": "Class", "fromName": "app\\Http\\Controllers", "fromLink": "app/Http/Controllers.html", "link": "app/Http/Controllers/OrganizationsController.html", "name": "app\\Http\\Controllers\\OrganizationsController", "doc": "&quot;\n&quot;"},
                                                        {"type": "Method", "fromName": "app\\Http\\Controllers\\OrganizationsController", "fromLink": "app/Http/Controllers/OrganizationsController.html", "link": "app/Http/Controllers/OrganizationsController.html#method_index", "name": "app\\Http\\Controllers\\OrganizationsController::index", "doc": "&quot;Display a listing of the resource.&quot;"},
                    {"type": "Method", "fromName": "app\\Http\\Controllers\\OrganizationsController", "fromLink": "app/Http/Controllers/OrganizationsController.html", "link": "app/Http/Controllers/OrganizationsController.html#method_organization", "name": "app\\Http\\Controllers\\OrganizationsController::organization", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "app\\Http\\Controllers\\OrganizationsController", "fromLink": "app/Http/Controllers/OrganizationsController.html", "link": "app/Http/Controllers/OrganizationsController.html#method_create", "name": "app\\Http\\Controllers\\OrganizationsController::create", "doc": "&quot;Show the form for creating a new resource.&quot;"},
                    {"type": "Method", "fromName": "app\\Http\\Controllers\\OrganizationsController", "fromLink": "app/Http/Controllers/OrganizationsController.html", "link": "app/Http/Controllers/OrganizationsController.html#method_store", "name": "app\\Http\\Controllers\\OrganizationsController::store", "doc": "&quot;Store a newly created resource in storage.&quot;"},
                    {"type": "Method", "fromName": "app\\Http\\Controllers\\OrganizationsController", "fromLink": "app/Http/Controllers/OrganizationsController.html", "link": "app/Http/Controllers/OrganizationsController.html#method_show", "name": "app\\Http\\Controllers\\OrganizationsController::show", "doc": "&quot;Display the specified resource.&quot;"},
                    {"type": "Method", "fromName": "app\\Http\\Controllers\\OrganizationsController", "fromLink": "app/Http/Controllers/OrganizationsController.html", "link": "app/Http/Controllers/OrganizationsController.html#method_edit", "name": "app\\Http\\Controllers\\OrganizationsController::edit", "doc": "&quot;Show the form for editing the specified resource.&quot;"},
                    {"type": "Method", "fromName": "app\\Http\\Controllers\\OrganizationsController", "fromLink": "app/Http/Controllers/OrganizationsController.html", "link": "app/Http/Controllers/OrganizationsController.html#method_update", "name": "app\\Http\\Controllers\\OrganizationsController::update", "doc": "&quot;Update the specified resource in storage.&quot;"},
                    {"type": "Method", "fromName": "app\\Http\\Controllers\\OrganizationsController", "fromLink": "app/Http/Controllers/OrganizationsController.html", "link": "app/Http/Controllers/OrganizationsController.html#method_destroy", "name": "app\\Http\\Controllers\\OrganizationsController::destroy", "doc": "&quot;Remove the specified resource from storage.&quot;"},
            
            {"type": "Class", "fromName": "app\\Http\\Controllers", "fromLink": "app/Http/Controllers.html", "link": "app/Http/Controllers/ProfileController.html", "name": "app\\Http\\Controllers\\ProfileController", "doc": "&quot;\n&quot;"},
                                                        {"type": "Method", "fromName": "app\\Http\\Controllers\\ProfileController", "fromLink": "app/Http/Controllers/ProfileController.html", "link": "app/Http/Controllers/ProfileController.html#method_profile", "name": "app\\Http\\Controllers\\ProfileController::profile", "doc": "&quot;Display a listing of the resource.&quot;"},
            
            {"type": "Class", "fromName": "app\\Http\\Controllers", "fromLink": "app/Http/Controllers.html", "link": "app/Http/Controllers/RolesController.html", "name": "app\\Http\\Controllers\\RolesController", "doc": "&quot;\n&quot;"},
                                                        {"type": "Method", "fromName": "app\\Http\\Controllers\\RolesController", "fromLink": "app/Http/Controllers/RolesController.html", "link": "app/Http/Controllers/RolesController.html#method_roles", "name": "app\\Http\\Controllers\\RolesController::roles", "doc": "&quot;Display a listing of the resource.&quot;"},
            
            {"type": "Class", "fromName": "app\\Http\\Controllers", "fromLink": "app/Http/Controllers.html", "link": "app/Http/Controllers/UsersController.html", "name": "app\\Http\\Controllers\\UsersController", "doc": "&quot;\n&quot;"},
                                                        {"type": "Method", "fromName": "app\\Http\\Controllers\\UsersController", "fromLink": "app/Http/Controllers/UsersController.html", "link": "app/Http/Controllers/UsersController.html#method_members", "name": "app\\Http\\Controllers\\UsersController::members", "doc": "&quot;Display a listing of the resource.&quot;"},
                    {"type": "Method", "fromName": "app\\Http\\Controllers\\UsersController", "fromLink": "app/Http/Controllers/UsersController.html", "link": "app/Http/Controllers/UsersController.html#method_member", "name": "app\\Http\\Controllers\\UsersController::member", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "app\\Http\\Controllers\\UsersController", "fromLink": "app/Http/Controllers/UsersController.html", "link": "app/Http/Controllers/UsersController.html#method_user", "name": "app\\Http\\Controllers\\UsersController::user", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "app\\Http\\Controllers\\UsersController", "fromLink": "app/Http/Controllers/UsersController.html", "link": "app/Http/Controllers/UsersController.html#method_memberUpdate", "name": "app\\Http\\Controllers\\UsersController::memberUpdate", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "app\\Http\\Controllers\\UsersController", "fromLink": "app/Http/Controllers/UsersController.html", "link": "app/Http/Controllers/UsersController.html#method_memberDelete", "name": "app\\Http\\Controllers\\UsersController::memberDelete", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "app\\Http\\Controllers\\UsersController", "fromLink": "app/Http/Controllers/UsersController.html", "link": "app/Http/Controllers/UsersController.html#method_roles", "name": "app\\Http\\Controllers\\UsersController::roles", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "app\\Http\\Controllers\\UsersController", "fromLink": "app/Http/Controllers/UsersController.html", "link": "app/Http/Controllers/UsersController.html#method_guardian", "name": "app\\Http\\Controllers\\UsersController::guardian", "doc": "&quot;\n&quot;"},
            
            
                                        // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if "::" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\') > -1) {
            tokens = tokens.concat(term.split('\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Sami = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string "search" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            return term.replace(/<(?:.|\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return $.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    $(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = $('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href="/g, 'href="' + rootPath);
        Sami.injectApiTree($('#api-tree'));
    });

    return root.Sami;
})(window);

$(function() {

    // Enable the version switcher
    $('#version-switcher').change(function() {
        window.location = $(this).val()
    });

    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').click(function() {
            $(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = $('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = $('#api-tree');
            var node = $('#api-tree li[data-name="' + expected + '"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    
    
        var form = $('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Sami.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                $('#search-form').submit();
                return true;
            }
        });

    
});


