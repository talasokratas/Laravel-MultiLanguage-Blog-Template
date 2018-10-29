## How to install
<ol>
    <li> Download this project and if you have composer installed globally run
        <code>composer install</code> to install dependencies like bootstrap and jquery including ckeditor and laravel file-manager, though you'll find them already published in public folder,so this project can work immediately after following next commands</li>
    <li>Create relational database like mySQL, rename .env example to .env and edit this file to add connection to your new database</li>
    <li>Run <code>php artisan key:generate</code>to generate a key for app</li>
    <li>Run <code>php artisan migrate</code>to add tables to database</li>
    <li> Finally <code>php artisan serve</code> and now the project should be running
</ol>    
       

## About this project
<p> I've decided to make a blogsite for myself from scratch by using LARAVEL framework and I've realised that there's more to it than I've expected so I thought I could make a template from where I could start the next time, where basic functionality already exists, so from this point only work at the front-end, website content and additional functionality is needed. Unfortunately not all of the translations are made yet, but it's a good example how to add another language to your website. I'll expand more on it below on this page.</p>

## Summary 
<ul>
    <li>I've followed <a href="http://www.sutanaryan.com/2017/07/how-to-create-a-blog-with-laravel-5-part-1-file-structure-templating/">a laravel blog tutorial by SutanaRyan</a> I've learned a few things, though I saw I could improve some things as well. Major changes I've made was to remove form validation from controller's store and edit methods and created new request classes like PostRequest, Category request and CommnentRequest and added validation in there.
    <li>Creator of tutorial used a special Helper class he created himself to get info from other eloquent model , e.g. a helper method to display all comments that belongs to a post while using a method like <code>Helper::get_post_title($comment_id)</code>, while I think its much easier to make a eloquent relationship between them that Comments belong to one post, and one Post has many Comments, so after setting relationship it's possible to get post title this way <code> $comment->post->title </code> </li>
    <li>Found some minor mistakes like active page style wasn't working, changed some Helper class methods to Request class in blade.php files </li>
    <li>I've added new column to posts table for locale, and option to choose a language for the website and translations depending on chosen locale, read more on that in Localization section</li>
    <li>I've add WYSIWYG editor to create blog posts and pages. I've chosen CKEditor and itegerated it by following instalation and integration guides. At default it doesn't allow iframe and other tags, so embedding video from youtube wasn't possible. To make it available you need to open CKeditors config.js file and add this line <code>config.allowedContent = true;</code></li>
    <li>Following instrcutions laravel-file-manager was integrated, to make uploaded file management easier. It is important to set authorization middleware on file manager's routes so only authorized persons could upload files to your projects. It's mentioned in a guide. </li>
</ul>  

## Localization

<p>Localizition is achieved by adding extra locales to app.config file and translation files to resources/lang folder. I've chosen to use json format, you can see a file called lt.json in a lang folder. There it is possible to specify translations for specific language, in this case lithuanian, and it means that all text that uses this format <code> {{__('Text')}} </code> .blade.php files can be changed and translated according to set locale via before mentioned lt.json file. Copy validation.php file from lang/en folder to lang/yourlanguage folder to translate form validation attributes and messages. You can find some partially done translations in my project</p> 
<p>I've created Locale middleware with some function, which at first tries to find users's preffered language in user's browser, if it doesn't match available locales, then middleware is checking for saved locale in current session, if no locale is saved, tehn it falls back to default locale of en. Locale is set manually by using locale/{{locale}} route, which saves locale as session's as variable. Middleware checks's if session's locale has been chosen mannualy and if it is then middleware won't look for user's prefered locale in user's browser anymore</p>
<p>I've modified posts and pages controller methods, e.g. those menu pages and posts are shown that matches current locale
<p> In this project I'm not using different pages url slugs like /en/page or /lt/puslapis. In this project translations and views should be handled in blade.php files using some if statements while url adress would be the same for both en and lt languages 


## Resources
<a href="http://www.sutanaryan.com/2017/07/how-to-create-a-blog-with-laravel-5-part-1-file-structure-templating/">laravel blog tutorial by SutanaRyan</a>
<a href="https://github.com/UniSharp/laravel-ckeditor">laravel CKEditor</a>
<a href="https://github.com/UniSharp/laravel-filemanager">laravel-file-manager</a>
<a href="https://laravel.com/docs/5.7/localization">laravel localization</a>
