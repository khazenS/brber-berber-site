<h1>How to setup</h1>
<ul>
  <li>First, download the repo as a zip and open it</li>
  <li>Secondly, we need xampp download it and carry in this repo to xampp/htdocs folder</li>
  <li>Then, run the xampp and start the Apache and MySql section.</li>
  <li>Click the admin button that is on Mysql line on xampp.</li>
  <li>From opening screen click add button and enter name as brber-site and then import the brber-site.sql file then you got database datas.</li>
  <li>Finally, enter http://localhost/brber-berber-site/index.html path and start to use it!</li>
</ul>
<h1>About this site</h1>
<p>- This is an barber site that is including its own weekly queue system based on php backend.</p>
<p>- It has own special admin page. </p>
<p>- Also you can change the queue times  on admin page and see the costumers which take the queue.</p>
<p>- On admin page, you can add new cutting shop and costumers take the queues on another shop.(exatly you can delete the shop or queues)</p>
<p>- If you want, you would fix the frontend but I think it is not enough.I didnt scramble enough on it.</p>

</br>
<h3>Looking of site</h3>
<h4 align="center">This is main page of site</h4>
</br>

![image](https://github.com/khazenS/brber-berber-site/assets/95938485/6abd60f0-242d-4cc1-9c91-5170b607fe84)
![image](https://github.com/khazenS/brber-berber-site/assets/95938485/44d9f878-fef2-4602-bca7-4e6f0bff7c32)
![image](https://github.com/khazenS/brber-berber-site/assets/95938485/184740dc-4061-495b-9135-c6c7920f0cd6)
![image](https://github.com/khazenS/brber-berber-site/assets/95938485/8bdd1c3c-5256-44d4-bc78-6dc14d774691)
</br>
</br>
</br>
<h4 align="center">The queue page</h6>

</br>

![image](https://github.com/khazenS/brber-berber-site/assets/95938485/ef16c84e-da19-4726-81cb-3ffa53b7da2e)
</br>
<p>There are 3 cutting shop as a default and costumer will choose any of it.Then costumer see this page:</p>
</br>

![image](https://github.com/khazenS/brber-berber-site/assets/95938485/72d1f770-f513-4908-aecc-70c50ef65c81)

<p>Here is 3 different colors boxes these mean the system allow or not allow you to take queue.The green box is ready state to take queue ,
the red box is taken from another person and the yellow box is time over state so now time is 14:40 and before the time is over.You can only choose after it.</p>
<p>Lets imagine, if the time is Saturday 20:01,the table shows us al of it yellow rigth? But it is considered.
After Saturday 20:01, the table will render new weekly schedule.</p>
</br>
</br>
<h4 align="center">The admin entry page</h4>

![image](https://github.com/khazenS/brber-berber-site/assets/95938485/868cbadf-233d-4f69-b835-68a35a739e27)

<p>You can reach this page from <a href="http://localhost/brber-berber-site/pages/adminEntryPage.php">adminEntryPage</a> and username is 'admin' & password is 'admin' as a default.</p>
<p>If you try enter the admin page when you dont login on entry page. You will go to the main page so dont try that. </p>

<h4 align="center">The admin page</h4>

![image](https://github.com/khazenS/brber-berber-site/assets/95938485/1a11b1b3-e954-4bba-8ece-9d3b4ac9b2ea)
![image](https://github.com/khazenS/brber-berber-site/assets/95938485/6c037c82-6e4f-4dfa-b61e-ccfaf26b51db)

<p>You can see how many are people registered to your system and how many people took queue this week.</p>
<p>You can edit and delete a queue from here but you have just edited the hour of queue not day so if you want to edit the day of queue,you need to delete it and take a place again. </p>
<p>Also you see your places here and delete them.Under of it, you can add a new place to you.</p>

<h6>How to edit a queue?</h6>

![image](https://github.com/khazenS/brber-berber-site/assets/95938485/66b805f0-2737-46cb-a0ca-def42f9517e5)
<p>When you click the 'Duzenle' button you will see like that and he grey button that is you have been hour of queue then you can chooce whatever you want to change hour to.</p>
