import fileHandle


def puzzle3(input_file):
    data = fileHandle.readfile(input_file).strip().splitlines()
    score = 0
    for round_ in data:
        hand1 = ord(round_[0]) - ord('A') + 1
        hand2 = ord(round_[2]) - ord('X') + 1
        score += hand2
        match hand2 - hand1:
            case 0:
                score += 3
            case 1 | -2:
                score += 6
    return score


def puzzle4(input_file):
    data = fileHandle.readfile(input_file).strip().splitlines()
    score = 0
    for round_ in data:
        hand1 = ord(round_[0]) - ord('A') + 1
        result = ord(round_[2]) - ord('X')
        score += 3 * result
        match result:
            case 0:  # lose
                score += 3 if hand1 == 1 else hand1 - 1
            case 1:  # draw
                score += hand1
            case 2:  # win
                score += 1 if hand1 == 3 else hand1 + 1
    return score


print('Day #2, part one:', puzzle3('.\input\day2.txt'))
print('Day #2, part two:', puzzle4('.\input\day2.txt'))