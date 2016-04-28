-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 21, 2016 at 08:31 AM
-- Server version: 5.5.45-cll-lve
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `up720163_test`
--

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`idcomment`, `comment`, `question_idquestion`, `users_userID`, `child`) VALUES
(1, 'use Cmd-Shift-L on a mac (I think it''s Ctrl-Shift-L on win/linux). There''s also a setting to do this automatically as a tab becomes active. You can also right click on a tab and choose "reveal in file tree"', 2, 5, 0),
(2, 'When you''re working with garbage collection (10.5+), a weak reference is created by prefixing a variable declaration with __weak. When you assign to that variable, the GC (if enabled) keeps track of the reference and will zero it out for you automatically if all strong references to the referenced object disappear. (If GC is not enabled, the __weak attribute is ignored.)', 1, 2, 0),
(3, 'it is generally used only for raw C pointers to things like structs or primitives that the Garbage Collector will not treat as roots, and will be collected from under you if you don''t declare them as strong. ', 6, 1, 0),
(4, 'I''d clarify that by saying "if there are no non-weak references to an object". As soon as the last strong reference is removed, the object may be collected, and all weak references will be zeroed automatically.', 1, 5, 2),
(5, 'This isn''t directly related to creating weak references, but there is also a __strong attribute, but since Objective-C object variables are strong references by default', 1, 3, 2),
(6, 'Using assign to create weak references can be unsafe in a multithreaded system, particularly when either object can be retained by a third object, and then used to dereference the other object.', 1, 5, 3),
(7, 'Fortunately, this is often a problem of hierarchy, and the object containing the weak reference only cares about the object it refers to for the referred-to object''s lifetime. This is the usual situation with a Superior<->Subordinate relationship.', 1, 5, 0),
(8, 'Is _b the NSMutableArray ivar returned by self.blocks? If so, I''m assuming you mean [_b release] instead. Also, there''s no need to use self.blocks inside the class that holds the referencs — just use for (Block* b in _b). It might be l', 1, 7, 0),
(9, 'As long as Row is careful to release each Block before it is deallocated (ie, its dealloc should release the NSMutableArray which will release the Blocks as long as no one else has any pointers to them) then everything will be deallocated as appropriate', 1, 9, 0);

--
-- Dumping data for table `conversation`
--

INSERT INTO `conversation` (`id`, `userOne`, `userTwo`, `eTagHash`) VALUES
(23, 'David', 'Yen', 5016),
(22, 'David', 'ade', 29004),
(25, 'David', 'Liam', 13706),
(26, 'Liam', 'ade', 14800),
(28, 'kenboy', 'Liam', 26046),
(30, 'kenboy', 'Yen', 3636);

--
-- Dumping data for table `filer`
--

INSERT INTO `filer` (`fileID`, `fileName`, `fileLink`, `fileTags`, `users_userID`, `protect`) VALUES
(63, 'Lorem', '1456066343.pdf', '', 5, 0),
(64, '524', '1456066452.png', '', 9, 0),
(65, 'Test', '1456066600.pdf', '', 3, 1),
(66, 'wall', '1456066642.jpg', '', 2, 0),
(67, '499', '1456066685.jpg', '', 4, 0),
(68, 'getty', '1456066754.jpg', '', 6, 0),
(69, '48', '1456066838.png', '', 5, 1),
(70, 'Imagen', '1456066930.pdf', '', 7, 0),
(72, 'Ore', '1456067035.pdf', '', 8, 1),
(73, '894L', '1456067077.jpg', '', 5, 0),
(74, 'pdf', '1456067257.pdf', '', 1, 0),
(77, '7856', '1456067620.docx', '', 1, 1),
(78, 'Paper', '1456067695.jpg', '', 1, 0),
(79, 'Mk89', '1456067739.docx', '', 5, 0);

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`followID`, `user1`, `user2`) VALUES
(187, 1, 2),
(190, 7, 2),
(217, 5, 1),
(103, 2, 5),
(106, 3, 5);

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`idgroup`, `groupName`, `groupAdmin`) VALUES
(1, 'Social', 2),
(2, 'Web Tech Students', 1),
(3, 'Mountain Dew', 4),
(4, 'Software Design', 9);

--
-- Dumping data for table `groupFiles`
--

INSERT INTO `groupFiles` (`id`, `Name`, `Link`, `groupID`, `userID`) VALUES
(1, 'Lorem', '1456066343.pdf', 4, 5),
(2, '894L', '1456067077.jpg', 4, 5),
(3, 'Mk89', '1456067739.docx', 4, 5);

--
-- Dumping data for table `groupMessage`
--

INSERT INTO `groupMessage` (`idMessage`, `groupMessage`, `group_idgroup`, `users_userID`, `timestamp`) VALUES
(1, 'hello', 4, 5, 0),
(2, 'A quick movement of the enemy will jeopardize six gunboats. All questions asked by five watch experts amazed the judge. Jack quietly moved up front and seized the big ball of wax.\n', 4, 1, 0),
(3, 'hmm', 4, 2, 0),
(4, 'potter', 4, 5, 0),
(5, 'peter', 4, 1, 0),
(6, 'Woven silk pyjamas exchanged for blue quartz. Brawny gods just flocked up to quiz and vex him.', 4, 5, 0),
(7, 'run', 2, 2, 0),
(8, 'runner', 1, 3, 1450783905),
(9, 'alright', 4, 1, 1450785538),
(10, 'yes', 4, 5, 1450787100),
(11, 'Quick brown dogs jump over the lazy fox. The jay, pig, fox, zebra, and my wolves quack!', 4, 5, 1450787996),
(12, 'ok', 4, 1, 1450788362),
(13, 'bye', 4, 5, 1450788375),
(14, 'cwe', 4, 1, 1450810410),
(16, 'The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs.', 4, 5, 1450892907),
(75, 'hmmm', 4, 2, 1451477158),
(76, 'us', 4, 5, 1454025037),
(77, 'Added a new file called: nm', 4, 5, 1454025057),
(78, 'we dem boyz', 4, 1, 1454027308),
(80, 'i new', 4, 5, 1454027349),
(81, 'Amazingly few discotheques provide jukeboxes. My girl wove six dozen plaid jackets before she quit.', 4, 2, 1454027429),
(82, 'rundown', 4, 1, 1454027447);

--
-- Dumping data for table `group_has_users`
--

INSERT INTO `group_has_users` (`group_idgroup`, `users_userID`) VALUES
(1, 3),
(2, 2),
(4, 1),
(4, 2),
(4, 5);

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `conversationETag`, `sender`, `toWho`, `message`, `userRead`, `timestamp`) VALUES
(11, 5016, 'David', 'Yen', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 'yes', 0),
(39, 13706, 'David', 'Liam', 'Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.\n', 'yes', 0),
(40, 13706, 'Liam', 'David', 'A small river named Duden flows by their place and supplies it with the necessary regelialia.', 'yes', 0),
(41, 13706, 'Liam', 'David', 'Irans was good as well, Argentina was only able to score against them during extra time 90+1.', 'yes', 0),
(43, 5016, 'David', 'Hull', 'It is a paradisematic country, in which roasted parts of sentences fly into your mouth.', 'no', 0),
(55, 13706, 'Liam', 'David', 'Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.\n', 'yes', 0),
(45, 5016, 'David', 'Yen', 'The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.', 'yes', 0),
(46, 13706, 'David', 'Liam', 'She packed her seven versalia, put her initial into the belt and made herself on the way.', 'yes', 0),
(47, 5016, 'David', 'Yen', 'When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane.', 'yes', 0),
(73, 14800, 'Liam', 'ade', 'Pityful a rethoric question ran over her cheek, then she continued her way. On her way she met a copy.', 'no', 0),
(57, 13706, 'David', 'Liam', 'hey', 'yes', 0),
(56, 13706, 'Liam', 'David', 'The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country.', 'yes', 0),
(54, 13706, 'Liam', 'David', 'hello', 'yes', 0),
(72, 14800, 'Liam', 'ade', 'But nothing the copy said could convince her and so it didn’t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their projects again and again.', 'no', 0),
(59, 5016, 'David', 'Yen', 'And if she hasn’t been rewritten, then they are still using her.', 'yes', 0),
(61, 13706, 'David', 'Liam', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 'yes', 0),
(62, 13706, 'Liam', 'David', 'he quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV quiz graced by fox whelps.\n', 'yes', 0),
(63, 13706, 'David', 'Liam', 'Bawds jog, flick quartz, vex nymphs. Waltz, bad nymph, for quick jigs vex! Fox nymphs grab quick-jived waltz.', 'yes', 0),
(64, 13706, 'Liam', 'David', 'hello are you working', 'yes', 0),
(66, 13706, 'David', 'Liam', 'Quick zephyrs blow, vexing daft Jim. Sex-charged fop blew my junk TV quiz. How quickly daft jumping zebras vex.', 'yes', 0),
(67, 13706, 'Liam', 'David', 'omi', 'yes', 0),
(68, 13706, 'Liam', 'David', 'ora', 'yes', 0),
(69, 29004, 'David', 'ade', 'm', 'no', 0),
(70, 29004, 'David', 'ade', 'Two driven jocks help fax my big quiz. Quick, Baz, get my woven flax jodhpurs! "Now fax quiz Jack!', 'no', 0),
(85, 13706, 'David', 'Liam', 'alright', 'yes', 0),
(86, 29004, 'David', 'ade', '" my brave ghost pled. Five quacking zephyrs jolt my wax bed. Flummoxed by job, kvetching W. zaps Iraq.', 'no', 0),
(88, 26046, 'kenboy', 'Liam', 'ok lom', 'yes', 0),
(91, 13706, 'David', 'Liam', 'A wizard’s job is to vex chumps quickly in fog. Watch "Jeopardy! ", Alex Trebek''s fun TV quiz game.', 'yes', 0),
(90, 3636, 'Kenboy', 'Yen', 'A wizard’s job is to vex chumps quickly in fog. Watch "Jeopardy! ", Alex Trebek''s fun TV quiz game.', 'yes', 0),
(92, 13706, 'Liam', 'David', 'now', 'yes', 0),
(95, 5016, 'David', 'Yen', 'A wizard’s job is to vex chumps quickly in fog. Watch "Jeopardy! ", Alex Trebek''s fun TV quiz game.', 'yes', 0),
(94, 13706, 'Liam', 'David', 'Amazingly few discotheques provide jukeboxes. My girl wove six dozen plaid jackets before she quit.', 'yes', 1450694496),
(96, 5016, 'David', 'Yen', 'Amazingly few discotheques provide jukeboxes. My girl wove six dozen plaid jackets before she quit.', 'yes', 1450685093),
(117, 5016, 'David', 'Yen', 'yun', 'yes', 1450691101),
(116, 5016, 'David', 'Yen', 'oga', 'yes', 1450691022),
(125, 5016, 'Yen', 'David', 'wrong', 'yes', 1450693154),
(124, 5016, 'David', 'Yen', 'Foxy parsons quiz and cajole the lovably dim wiki-girl. Have a pick: twenty six letters - no forcing a jumbled quiz!', 'yes', 1450693097),
(123, 5016, 'David', 'Yen', 'again', 'yes', 1450692868),
(122, 5016, 'Yen', 'David', 'nm', 'yes', 1450692040),
(121, 5016, 'David', 'Yen', 'lllm', 'yes', 1450691854),
(120, 5016, 'David', 'Yen', 'Foxy parsons quiz and cajole the lovably dim wiki-girl. Have a pick: twenty six letters - no forcing a jumbled quiz!', 'yes', 1450691690),
(119, 5016, 'David', 'Yen', 'A quick movement of the enemy will jeopardize six gunboats. All questions asked by five watch experts amazed the judge. Jack quietly moved up front and seized the big ball of wax.\n', 'yes', 1450691497),
(118, 5016, 'Yen', 'David', 'nmp', 'yes', 1450691314),
(115, 5016, 'Yen', 'David', 'nm', 'yes', 1450690113),
(114, 5016, 'David', 'Yen', 'Six big devils from Japan quickly forgot how to waltz. Big July earthquakes confound zany experimental vow.', 'yes', 1450690044),
(126, 5016, 'David', 'Yen', 'lop', 'yes', 1450693733),
(127, 5016, 'Yen', 'David', 'loper', 'yes', 1450693819),
(128, 5016, 'David', 'Yen', 'loper', 'yes', 1450693853),
(138, 5016, 'David', 'Yen', 'run', 'yes', 1450694484);

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`idquestion`, `title`, `note`, `tags`, `users_userID`, `closed`) VALUES
(1, 'Accessing “containing class” from DependencyDescriptor', 'I''m working on a utility for supporting context-dependent injection, i.e. what gets injected can now also depend on where it is injected. Logger injection is a common application of this technique. So far, I''ve successfully implemented this for HK2 and Guice, and with some limitations for Dagger. To solve this for Spring, I''m using a BeanFactoryPostProcessor that registers an AutowireCandidateResolver. However, to achieve the intended semantics, I need to know the type of the actual target object, which may be different from the type that declares the injection point. For example:', 'ghg', 5, 1),
(2, 'Cloud9, open file from tree on single click?', 'My question is pretty basic but I can''t find anything on the user preferences (file or from the UI) inside the editor, or on the web about it.\n\nI simply want the files to be opened when I click on them, not double click, but single click.\n\nHow can I do that?\n\nThanks in advance.', 'de', 3, 0),
(3, 'Java class with DTD to XML', 'Now i have to write a XML DTD (Document Type Definition) to map these Informations to save them in a XML file later.\n\nI searched the problem with google, but i can only find the way XML to Class not my way.\n\nWould be nice if someone could explain me, how it works and what the DTD is', 'erfrefr', 1, 0),
(4, 'How to rectify no publication after PhD graduation?', 'My situation is very strange.\n\nI have completed a sociology PhD from a well-regarded university. As I was a part-time candidate and holding a full-time job in the private sector, I guess my supervisor did not impress on me the importance of publishing. In addition, the university has no requirements to publish in order to graduate (though all academics there, including my supervisor, have strong publication records).\n\nI cannot blame my supervisor entirely because I should have known better (but doing it part-time outside the university environment and in a role that puts no importance to academic research are the main reasons for my current situation).\n\nI am now realising that lack of publication is severely restricting my career aspirations. For instance, I want to pursue university teaching (one of the main reasons for me to do my PhD) but I have not had any luck so far because most roles require "a proven / demonstrated record of publication" etc. Another example is that I want to establish a credible standing for myself and a list of publications would certainly help in this regard\n\nI can point to various "research" I have done in my current role but they don''t count as research in an academic (peer-reviewed) or formal sense.\n\nAs I have graduated now, I am no longer affiliated with any university. To make matters worse, my supervisor is mostly out of country doing research etc., so he is largely uncontactable. I can use my company''s name, but it is a small obscure firm in the overall scheme of things. My PhD is in the field that I am currently working in, so I can get some credibility in that sense.\n\nI have thought about open access publishing (in reputable journals) and turning my PhD into a book but unsure about them.\n\nQUESTION: How do I rectify my situation of no publication?', 'gregt', 5, 0),
(5, 'Is a short CV problematic?', 'I am currently an undergraduate student in mathematics, applying for graduate programs. To this end, I need to create a CV.\n\nI have no research experience, no scholarships/awards, no academic/volunteer service, no work experience, and my first teaching experience will occur next semester.\n\nMy CV includes:\n\nPersonal Data\nEducation\nTeaching Experience\nLanguages\nInterests and Activities\nand as of now, it is barely more than half a page long.\n\nIs this problematic? Is there anything else I should add to my CV?', 'ddb', 5, 0),
(6, 'How can I mentally prepare for grad school? [on hold]', 'I''m starting grad school in the Fall and what worries me isn''t the material. I''m good at my subject, I know I will be fine. What worries me are the stresses. Grad school is stressful. Even the impending stress is stressful.\n\nI am planning on studying more of my subject before entering which is the easy part, the hard part is learning to cope with the stress. Can you recommend a book, meditation practice, etc.?', 'm', 2, 0),
(7, 'Artificial meteor displays', 'Small debris thrown from a satellite down towards Earth will burn up in the atmosphere, but how much precision could it be done with. Would it be feasible with the correct launcher and precise timing to create sequences of distinct formations and patterns when viewed from the right place on Earth? Eg. could you realistically create a ring of meteors or would you just achieve a bunch arriving at roughly the same time? What would the best material be to make artificial meteors from and could their colour be varied by the chemical consistency?', 'oga,aburo', 8, 0),
(8, 'Only big cities survive. Will the humanity survive?', 'Let''s pretend that somewhere around our current time there exists a secret superweapon that kills humans nearly instantly but doesn''t cause significant damage to structures or nature (flora and fauna). And it is used globally. At the same time, there is a secret defense initiative that installed shields in major cities. Let''s say, the cities with population of 2+ million people. In Europe these are Istanbul, Moscow, London, St.Petersburg, Berlin, Madrid, Rome, Kiev and Paris.', NULL, 4, 0),
(9, 'Which type of creatures could exist in a volcano world?', 'A volcano is a rupture in the crust of a planetary-mass object, such as Earth, that allows hot lava, volcanic ash, and gases to escape from a magma chamber below the surface.', NULL, 7, 0),
(10, 'How to implement radical cultural mindset shift?', 'Generational ship problem again:\r\n\r\nEarth, far future: Generational ship left Earth for 20 generations long (600 years) voyage to another system. The ship is well built and even the people survive on the ship and make it to their new home.\r\n\r\nThere is one assumption which stroke me: One cultural norm has to be present for the voyage. I call it "Hobbit mindset":\r\n', NULL, 1, 0);

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subjectID`, `subjectName`) VALUES
(1, 'Data Structures and Algorithms'),
(2, 'Introduction to Software Engineering'),
(3, 'Web-Script Programming'),
(4, 'Functional Programming');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `email`, `password`, `school`, `course`, `picture`, `points`) VALUES
(1, 'Liam', 'test@example.com', 'ade', 'Portsmouth University', 'SOFTWARE ENGINEERING', '1454089507.jpg', 10),
(2, 'ade', 'adecrown1@live.co.uk', 'password', 'Portsmouth University', 'Maths', '1454089365.jpg', 21),
(3, 'added', 'wer@you.com', 'password', 'Oxford University', 'Computing', '1454089408.jpg', 6),
(4, 'Hull', 'jksf@kfs.com', 'password', 'Bradford University', 'English', '1454089443.jpg', 10),
(5, 'David', 'jkjjk@hghgh.com', 'adecrown678', 'Portsmouth University', 'SOFTWARE ENGINEERING', '1454089251.jpg', 20),
(6, 'Yen', 'adeg@hj.com', 'password', 'Portsmouth University', 'Web Design', '1454089551.jpg', 10),
(7, 'kenboy', 'kenboy@you.com', 'adecrown678', 'luba', 'Data Design', '1454089655.png', 10),
(8, 'malik', 'malik@me.com', 'adecrown678', 'Leeds University', 'Web Development', '1454089698.jpg', 10),
(9, 'Clement', 'gvhbjn@dfgh.com', 'password', 'Portsmouth University', 'kjhb', '1454090694.png', 10);

--
-- Dumping data for table `usersFollowsSubject`
--

INSERT INTO `usersFollowsSubject` (`users_userID`, `subject_subjectID`) VALUES
(1, 0),
(1, 1),
(5, 0),
(5, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
