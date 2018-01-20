#Example code by Kamal Shadi
#https://pypi.python.org/pypi/Localization/0.1.4

import localization as lx

P=lx.Project(mode='Earth1',solver='LSE')

#Florence KY
P.add_anchor('anchore_A',(-84.647016, 38.987219))

#Milford OH
P.add_anchor('anchore_B',(-84.281874, 39.170811))

#Northgate OH
P.add_anchor('anchore_C',(-84.592682, 39.2528348))

t,label=P.add_target()

t.add_measure('anchore_A',0.34)
t.add_measure('anchore_B',0.34)
t.add_measure('anchore_C',0.34)

P.solve()

print t.loc
