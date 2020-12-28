## Car-Connect

A car comparison portal which uses Natural Language Processing (NLP) and Machine Learning to visually compare 2 cars. Sentiment analysis is performed by car name and year. View video demo : 

## Installation
1) Initial Setup
- Open [ProjCar Conf settings XAMPP.rtf](ProjCar Conf settings XAMPP.rtf) and follow the steps to increase import limitations of XAMPP.
- Create Database autoexpress - latin1_swedish_ci collation.
- Import [autoexpress.sql](autoexpress.sql). 6 Tables will be imported into autoexpress database. 
- Install necessary python modules from setup.py. (sys, tweepy, textblob, matplotlib etc.)


2) Configuration
- Make sure your username is root and password is blank for database to work. If you are using something else, change it in config.php.
- Admin login username is "asd" and password is "leoleo".
- You need to create a twitter developer account for sentiment analysis to work. Get your secret keys and tokens and fill it into *"TODO"* of [main.py](main.py) and [viewTwee.py](twitter/viewTwee.py).
- You need to make sure where your python is installed and update the path in details.php file according to that. **(Line 143)** in [details.php](autoexpres/details.php) and **(Line 140)** in [details-cmp](autoexpress/details-cmp.php). The project will **NOT WORK** till you fix the paths.
- Get your Google location API secret keys and tokens. Fill into todo **YOUR_KEY_HERE** of [locator/index.html](locator/index.html).


## How does it work?
- The details.php and comparing.php is of vital importance since magic happens there. The python script fetches tweets from twitter for a particular vehicle say Honda Civic and stores them in a file **results.csv**. 
- You will need to note the location in your file system, it differs in Windows and macOS. Two files are included which are identical to deal with this: [main.py](main.py) and [mainForMacOS.py](mainForMacOS.py). 
- The tweets are then cleaned and polarity is calculated which is then categorized and displayed as charts.
- File in autoexpress folder such as details.php is responsible for inventory page and details-cmp is responsible for side-by-side comparison. 
- There are files such as HondaCIVIC2019.html that fetch data from [sirv.com](sirv.com) to render a 360 degree image of cars. 

## What does what?
- Multiple iframes are used. compare.php is running autoexpress/index.html in iframe and login is running login1.php in iframe etc. 
- If you wish to make changes, find the source file such as autoexpress/index.html etc. 
- Run twitter/viewTwee.py in cmd/terminal or python interpreter of your choice. The app will run on flask and will be integrated into iframe.
- To use feedback you need mercury mail server or other mail server. 
- Admin login is used to add or delete vehicle inventory. Same can be directly achieved via phpmyadmin.
- Sign in area is used for customer login and favoriting cars.


## Why is it this way?
The project is complicated enough and uses multiple components to achieve the features implemented. This was my Bachelor's project and I was low on time so had to implement it efficiently. Is there a better way? maybe, if you wish to optimize, do so and share it with the beautiful community.  

**Credits:**  
- This project is built upon [autoexpress](https://github.com/tramyardg/autoexpress) project by Raymart. I am extremely grateful to him for the support and quick response via email. His choice to keep the project open-source is the pushing factor for me to make my project open source as well and see what the community can do to make it better. 

- The python script for charts is written by this [guy](https://github.com/harunshimanto/Twitter-Sentiment-Analysis).
-  Let me know if you are an author of any other files included, I would be more than happy to credit you.

If you wish to develop on this project and use those files, do not forget to give credit to all the authors of this project including me. 