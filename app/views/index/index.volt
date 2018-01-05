{{ content() }}

<h1>Article status</h1>
<div style="float: left;">
    {% if newarticles|length > 0 %}
        <h2>Last added</h2>
        {% for article in newarticles %}
            <div class="important">
                <a href="http://www.amusementindex.com/articles/{{ article.filename }}">{{ article.listtitle }} {{ article.id }}</a><br />
                {{ article.listdescription }}<br />
                <span>{{ article.publishdate }}</span>
            </div>
            <p><hr noshade="noshade"></p>
        {% endfor %}
        <br /><br />
    {% endif %}

    {% if lastmodifiedarticles|length > 0 %}
        <h2>Last modified</h2>
        {% for article in lastmodifiedarticles %}
            <div class="important">
                <a href="http://www.amusementindex.com/articles/{{ article.filename }}">{{ article.listtitle }} {{ article.id }}</a><br />
                {{ article.listdescription }}<br />
                <span>{{ article.modifydate }}</span>
            </div>
            <p><hr noshade="noshade"></p>
        {% endfor %}
        <br /><br />
    {% endif %}
</div>
