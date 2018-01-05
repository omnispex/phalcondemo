<?php
use Phalcon\Mvc\View,
    Phalcon\Tag;

class IndexController extends ControllerBase
{
    /**
     * Retrieve general data necessary for all pages
     * @Source(key="initialize",lifetime=86400)
     * @return view
     */
    public function initialize()
    {
        parent::initialize();
    }

    /**
     * Loads the indexpage
     * @Source(key="indexAction",lifetime=86400)
     * @return view
     */
    public function indexAction()
    {
        $this->view->canonical=$this->config->urls->websiteUrl;

        $newarticles=$this->modelsManager->createBuilder()
            ->columns(array('Articles.id','Articles.listtitle','Articles.listdescription','Articles.filename','Articles.adddate','Articles.modifydate','Articles.publishdate','Articles.expiredate','Users.username','Users.realname','Images.path','Images.thumbnail'))
            ->from('Articles')
            ->innerJoin('Categoryarticles','Articles.id = Categoryarticles.articleid')
            ->innerJoin('Categories','Categoryarticles.categoryid = Categories.id')
            ->innerJoin('Users','Articles.publishid=Users.id')
            ->leftJoin('Images','Articles.iconid=Images.id')
            ->where('Articles.languagekey=:languagekey:',array('languagekey' => $this->languagekey()))
            ->andWhere('Articles.trash=:trash:',array('trash' => 'no'))
            ->andWhere('Articles.publishdate BETWEEN :startdate: AND :enddate:',array('startdate' => date("Y-m-d",time()-86400*90),'enddate' => date('Y-m-d')))
            ->andWhere('Articles.expiredate>:date:',array('date' => date('Y-m-d')))
            ->andWhere('Categories.languagekey=:languagekey:',array('languagekey' => $this->languagekey()))
            ->andWhere('Categories.trash=:trash:',array('trash' => 'no'))
            ->andWhere('Users.languagekey=:languagekey:',array('languagekey' => $this->languagekey()))
            ->andWhere('Users.trash=:trash:',array('trash' => 'no'))
            ->orderBy('Articles.publishdate DESC')
            ->groupBy(array('Articles.id'))
            ->limit(10)
            ->getQuery()
            ->execute();

        $lastmodifiedarticles=$this->modelsManager->createBuilder()
            ->columns(array('Articles.id','Articles.listtitle','Articles.listdescription','Articles.filename','Articles.adddate','Articles.modifydate','Articles.publishdate','Articles.expiredate','Users.username','Users.realname','Images.path','Images.thumbnail'))
            ->from('Articles')
            ->innerJoin('Categoryarticles','Articles.id = Categoryarticles.articleid')
            ->innerJoin('Categories','Categoryarticles.categoryid = Categories.id')
            ->innerJoin('Users','Articles.publishid=Users.id')
            ->leftJoin('Images','Articles.iconid=Images.id')
            ->where('Articles.languagekey=:languagekey:',array('languagekey' => $this->languagekey()))
            ->andWhere('Articles.trash=:trash:',array('trash' => 'no'))
            ->andWhere('Articles.publishdate<=:date:',array('date' => date('Y-m-d')))
            ->andWhere('Articles.expiredate>:date:',array('date' => date('Y-m-d')))
            ->andWhere('Articles.publishdate<>Articles.modifydate')
            ->andWhere('Articles.modifydate BETWEEN :startdate: AND :enddate:',array('startdate' => date("Y-m-d",time()-86400*90),'enddate' => date('Y-m-d')))
            ->andWhere('Categories.languagekey=:languagekey:',array('languagekey' => $this->languagekey()))
            ->andWhere('Categories.trash=:trash:',array('trash' => 'no'))
            ->andWhere('Users.languagekey=:languagekey:',array('languagekey' => $this->languagekey()))
            ->andWhere('Users.trash=:trash:',array('trash' => 'no'))
            ->orderBy('Articles.modifydate DESC')
            ->groupBy(array('Articles.id'))
            ->limit(10)
            ->getQuery()
            ->execute();

        $this->view->newarticles=$newarticles;
        $this->view->lastmodifiedarticles=$lastmodifiedarticles;
        $this->view->pick('index/index');
    }
}