#My Blog Engine! 

This is my small blog engine created for my personal use, but is free to use for
anyone else, if you feel inclined to do so. ( But I wouldn't recommend it )

##About
The engine is developed for an apache2 server, but might work on other server types
to, if you are lucky.

##Usage
Make sure that you have php installed on the server.

Copy all the files into a directory accessible by the server.

###Creating directories
In that directory, create an ``./entries`` directory and put at least one file
in it. Then create:
``
./footnote/about.md
./footnote/contact.md
./footnote/legal.md
./footnote/qna.md
`` 

###Choosing settings
For apache's rewrite engine ``rewrite.conf`` is included, with instructions on
where to put it.

In the files ``content-strings.ini`` and ``urls.ini`` can further settings be
found ( that you should take a look on ).

In ``blog.php`` there is a link to my Disqus comments. I strongly recommend that
you change what discussion this points to.

###Writing entries
The engine is built on Parsedown, which allows the entries to be written in 
markdown.

All blog entries that should be published should be put in the ``/entries`` folder.  
Preferably, they should be named according to the format: ``YYYYMMDDFile_name.md``
due to how the engine checks for dates, and how the list functionality renders
the entries.

##Licensing
Parsedown is licensed under the MIT license, detailed [here](./LICENSE_PARSEDOWN.php).

The blog engine in itself is currently not licensed under any license, but is due
to be licensed under the GNU GPL, as soon as the Disqus comments are replaced
by a free alternative.
