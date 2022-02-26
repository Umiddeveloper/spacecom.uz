<p align="center">
    <a href="#" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">CMS on Yii 2 Advanced</h1>
    <br>
</p>

> rename everywhere `spacecom.uz` to your "project name"(docker-compose.yml, ...)

Features:
- docker ready
- added primary user via migration
- Added yii2-cms & primary configured.
- fallback image saved in storage directory
- AdminLTE integrated & menu prepared
- reCaptcha v2 & primary config
- Frontend Locales config by Codemix extension & urlManager primary config
!- Frontend added blog controller & view
!- Frontend added to SiteController actionPage & view
!- Frontend Menu widget
!- Frontend Slider widget 
!- Frontend Header, Footer widget 
!- ```todo``` fix spacecom.uz widgets: languages with support after change stay current URI, ...
!- ```todo``` add security fixes

---

use command for docker build/up/down:

```make init``` <em>(all processes with one command with composer <strong>install</strong> and you can go sleep)</em>

```make update``` <em>(all processes with one command with composer <strong>update</strong> and you can go sleep)</em>

```make rm``` <em>(remove all project's docker containers with deleting <strong>mysql</strong> data)</em>

```make db```

```make du```

```make dd```

```make de```

Frontend URI: [http://localhost:20080](localhost:20080)

Backend URI: [http://localhost:20081](localhost:20081)

Storage URI: [http://localhost:20082](localhost:20082)

---

login: adm!n

password: 
