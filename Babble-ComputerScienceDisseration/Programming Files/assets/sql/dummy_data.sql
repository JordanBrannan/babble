INSERT INTO Institute VALUES (NULL, 'Goldsmiths');
INSERT INTO Institute VALUES (NULL, 'Westminster');
INSERT INTO Institute VALUES (NULL, 'Kings');

INSERT INTO Team VALUES (NULL, 'John Smith', 'Teacher', 'john.smith@gmail.com', 'password', '1');
INSERT INTO Team VALUES (NULL, 'Bob Jones', 'Teacher', 'bob.jones@gmail.com', 'password', '2');
INSERT INTO Team VALUES (NULL, 'Gary Brown', 'Temp Teacher', 'gary.brown@gmail.com', 'password', '3');

INSERT INTO User VALUES (NULL);
INSERT INTO User VALUES (NULL);
INSERT INTO User VALUES (NULL);
INSERT INTO User VALUES (NULL);
INSERT INTO User VALUES (NULL);
INSERT INTO User VALUES (NULL);

INSERT INTO MessageGroup VALUES (NULL, '1', '3', 'no');
INSERT INTO MessageGroup VALUES (NULL, '2', '3', 'yes');
INSERT INTO MessageGroup VALUES (NULL, '3', '2', 'no');
INSERT INTO MessageGroup VALUES (NULL, '3', '2', 'no');
INSERT INTO MessageGroup VALUES (NULL, '2', '1', 'no');
INSERT INTO MessageGroup VALUES (NULL, '2', '1', 'yes');

INSERT INTO Messages VALUES (NULL, 'testing1', NULL, 'out', '1', NULL);
INSERT INTO Messages VALUES (NULL, 'testing2', NULL, 'in', '1', '1');
INSERT INTO Messages VALUES (NULL, 'testing3', NULL, 'out', '1', NULL);
INSERT INTO Messages VALUES (NULL, 'testing4', NULL, 'in', '1', '2');
INSERT INTO Messages VALUES (NULL, 'testing5', NULL, 'in', '1', '3');
INSERT INTO Messages VALUES (NULL, 'testing6', NULL, 'out', '1', '2');
