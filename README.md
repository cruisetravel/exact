Exact transformer
=================

Transforms exact xml to davinci csv

Setup
-----

Add virtual host:
```
<VirtualHost 127.0.0.1>
  ServerName exact.dev
  DocumentRoot "/path/to/application/root/web"
  DirectoryIndex app.php
  <Directory "/path/to/application/root/web">
    AllowOverride All
    Allow from All
  </Directory>
</VirtualHost>
```
Add host to your host file:
```
127.0.0.1 exact.dev
```
Make cache & log dirs writeable
```
sudo chmod -R 777 /path/to/application/root/app/cache
sudo chmod -R 777 /path/to/application/root/app/logs
```
Install vendors
```
composer install
```

Usage
-----
go to http://exact.dev/
paste your xml in the form e.g.
```xml
<ExactFinancials>
	<BankJournalEntries>
		<BankJournalEntry admNr="621" finYr="2016" period="6" journalNr="20" seqnrAtrsh="360000001">
			<Values>
				<EntryNr>16200011</EntryNr>
				<Descr>Test export XML bankboeking</Descr>
			</Values>
			<BankJournalEntryLines>
				<BankJournalEntryLine seqnrAtrsh="1" linenrAtrss="1">
					<Values>
						<DateLine>2016-06-26</DateLine>
						<DescrLine>Test export XML bankboeking</DescrLine>
						<AccNr>1110</AccNr>
						<DebtorLine>600</DebtorLine>
						<OutstItemEntryNr>201570000004</OutstItemEntryNr>
						<OutstItemCurrCode>EUR</OutstItemCurrCode>
						<OutstItemExchRate>1</OutstItemExchRate>
						<AmountFc>87</AmountFc>
						<AmountDc>87</AmountDc>
					</Values>
				</BankJournalEntryLine>
			</BankJournalEntryLines>
		</BankJournalEntry>
		<BankJournalEntry admNr="621" finYr="2016" period="6" journalNr="20" seqnrAtrsh="360000001">
			<Values>
				<EntryNr>16200011</EntryNr>
				<Descr>Test export XML bankboeking</Descr>
			</Values>
			<BankJournalEntryLines>
				<BankJournalEntryLine seqnrAtrsh="1" linenrAtrss="1">
					<Values>
						<DateLine>2016-06-26</DateLine>
						<DescrLine>Test export XML bankboeking</DescrLine>
						<AccNr>1300</AccNr>
						<DebtorLine>600</DebtorLine>
						<OutstItemEntryNr>201570000004</OutstItemEntryNr>
						<OutstItemCurrCode>EUR</OutstItemCurrCode>
						<OutstItemExchRate>1</OutstItemExchRate>
						<AmountFc>-87</AmountFc>
						<AmountDc>-87</AmountDc>
					</Values>
				</BankJournalEntryLine>
			</BankJournalEntryLines>
		</BankJournalEntry>
		<BankJournalEntry admNr="621" finYr="2016" period="6" journalNr="20" seqnrAtrsh="360000001">
			<Values>
				<EntryNr>16200011</EntryNr>
				<Descr>Test export XML bankboeking</Descr>
			</Values>
			<BankJournalEntryLines>
				<BankJournalEntryLine seqnrAtrsh="1" linenrAtrss="2">
					<Values>
						<DateLine>2016-06-26</DateLine>
						<DescrLine>Test export XML bankboeking</DescrLine>
						<AccNr>1110</AccNr>
						<DebtorLine>1020</DebtorLine>
						<OutstItemEntryNr>14700003</OutstItemEntryNr>
						<OutstItemCurrCode>EUR</OutstItemCurrCode>
						<OutstItemExchRate>1</OutstItemExchRate>
						<AmountFc>1200</AmountFc>
						<AmountDc>1200</AmountDc>
					</Values>
				</BankJournalEntryLine>
			</BankJournalEntryLines>
		</BankJournalEntry>
		<BankJournalEntry admNr="621" finYr="2016" period="6" journalNr="20" seqnrAtrsh="360000001">
			<Values>
				<EntryNr>16200011</EntryNr>
				<Descr>Test export XML bankboeking</Descr>
			</Values>
			<BankJournalEntryLines>
				<BankJournalEntryLine seqnrAtrsh="1" linenrAtrss="2">
					<Values>
						<DateLine>2016-06-26</DateLine>
						<DescrLine>Test export XML bankboeking</DescrLine>
						<AccNr>1300</AccNr>
						<DebtorLine>1020</DebtorLine>
						<OutstItemEntryNr>14700003</OutstItemEntryNr>
						<OutstItemCurrCode>EUR</OutstItemCurrCode>
						<OutstItemExchRate>1</OutstItemExchRate>
						<AmountFc>-1200</AmountFc>
						<AmountDc>-1200</AmountDc>
					</Values>
				</BankJournalEntryLine>
			</BankJournalEntryLines>
		</BankJournalEntry>
		<BankJournalEntry admNr="621" finYr="2016" period="6" journalNr="20" seqnrAtrsh="360000001">
			<Values>
				<EntryNr>16200011</EntryNr>
				<Descr>Test export XML bankboeking</Descr>
			</Values>
			<BankJournalEntryLines>
				<BankJournalEntryLine seqnrAtrsh="1" linenrAtrss="3">
					<Values>
						<DateLine>2016-06-26</DateLine>
						<DescrLine>Test export XML bankboeking</DescrLine>
						<AccNr>1110</AccNr>
						<DebtorLine>1040</DebtorLine>
						<OutstItemEntryNr>901026</OutstItemEntryNr>
						<OutstItemCurrCode>EUR</OutstItemCurrCode>
						<OutstItemExchRate>1</OutstItemExchRate>
						<AmountFc>4581.46</AmountFc>
						<AmountDc>4581.46</AmountDc>
					</Values>
				</BankJournalEntryLine>
			</BankJournalEntryLines>
		</BankJournalEntry>
		<BankJournalEntry admNr="621" finYr="2016" period="6" journalNr="20" seqnrAtrsh="360000001">
			<Values>
				<EntryNr>16200011</EntryNr>
				<Descr>Test export XML bankboeking</Descr>
			</Values>
			<BankJournalEntryLines>
				<BankJournalEntryLine seqnrAtrsh="1" linenrAtrss="3">
					<Values>
						<DateLine>2016-06-26</DateLine>
						<DescrLine>Test export XML bankboeking</DescrLine>
						<AccNr>1300</AccNr>
						<DebtorLine>1040</DebtorLine>
						<OutstItemEntryNr>901026</OutstItemEntryNr>
						<OutstItemCurrCode>EUR</OutstItemCurrCode>
						<OutstItemExchRate>1</OutstItemExchRate>
						<AmountFc>-4581.46</AmountFc>
						<AmountDc>-4581.46</AmountDc>
					</Values>
				</BankJournalEntryLine>
			</BankJournalEntryLines>
		</BankJournalEntry>
		<BankJournalEntry admNr="621" finYr="2016" period="6" journalNr="20" seqnrAtrsh="360000001">
			<Values>
				<EntryNr>16200011</EntryNr>
				<Descr>Test export XML bankboeking</Descr>
			</Values>
			<BankJournalEntryLines>
				<BankJournalEntryLine seqnrAtrsh="1" linenrAtrss="4">
					<Values>
						<DateLine>2016-06-26</DateLine>
						<DescrLine>Test export XML bankboeking</DescrLine>
						<AccNr>1110</AccNr>
						<DebtorLine>1040</DebtorLine>
						<OutstItemEntryNr>34000002</OutstItemEntryNr>
						<OutstItemCurrCode>EUR</OutstItemCurrCode>
						<OutstItemExchRate>1</OutstItemExchRate>
						<AmountFc>-150</AmountFc>
						<AmountDc>-150</AmountDc>
					</Values>
				</BankJournalEntryLine>
			</BankJournalEntryLines>
		</BankJournalEntry>
		<BankJournalEntry admNr="621" finYr="2016" period="6" journalNr="20" seqnrAtrsh="360000001">
			<Values>
				<EntryNr>16200011</EntryNr>
				<Descr>Test export XML bankboeking</Descr>
			</Values>
			<BankJournalEntryLines>
				<BankJournalEntryLine seqnrAtrsh="1" linenrAtrss="4">
					<Values>
						<DateLine>2016-06-26</DateLine>
						<DescrLine>Test export XML bankboeking</DescrLine>
						<AccNr>1300</AccNr>
						<DebtorLine>1040</DebtorLine>
						<OutstItemEntryNr>34000002</OutstItemEntryNr>
						<OutstItemCurrCode>EUR</OutstItemCurrCode>
						<OutstItemExchRate>1</OutstItemExchRate>
						<AmountFc>150</AmountFc>
						<AmountDc>150</AmountDc>
					</Values>
				</BankJournalEntryLine>
			</BankJournalEntryLines>
		</BankJournalEntry>
	</BankJournalEntries>
</ExactFinancials>
```
click submit and save the resulting csv file
